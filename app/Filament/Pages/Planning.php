<?php

namespace App\Filament\Pages;

use App\Models\PlanningSettings;
use App\Services\AnthropicService;
use App\Services\PlanningPrepareDataService;
use Exception;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;

class Planning extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.planning';

    protected string $jsonData;
    public array $data = [];
    public $isLoading = false;

    // protected $anthropicService;

    public function __construct()
    {
        // dd(json_encode());

        $this->jsonData = file_get_contents(base_path('exampleData.json'));
        // dd(json_decode($this->jsonData, true));
        $this->data = json_decode($this->jsonData, true);
    }

    public function generatePlanning()
    {
        $anthropicService = new AnthropicService();
        $prompt = $this->generatePrompt();
        // $prompt = 'Hola, soy Javii, saludame';
        // $prompt = 'Generame de nuevo el planning semanal de comidas, sin repetir ninguno de los platos que ya me has generado. Pero respeta el mismo formato de la respuesta inicial, tiene que ser idéntico';
        // Log::info($prompt);
        // dd($prompt);
        
        // Con API Anthropic
        $this->isLoading = true;
        try {
            $response = $anthropicService->generateResponse($prompt);
            $formatedResponse = $this->getPlanningFromRespose($response);
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $this->isLoading = false;
        }
        
        // Con ejemplo de respuesta
        // $response = file_get_contents(base_path('responseAPIAnthropic.json'));
        // $responseData = json_decode($response, true);
        // $formatedResponse = $this->getPlanningFromRespose($responseData['content'][0]['text']);
        


        $this->data = $formatedResponse;
        // dd($this->data);
        // $this->data = json_decode($response, true);
    }



    private function generatePrompt()
    {
        // $introduction = 'Quiero que generes un planning semanal de comidas. Para ello te pasaré un json con información en la que encontrarás:
        // - weekDays: Los días de la semana para los cuales debes generar comidas.
        // - numberOfMealsPerDay: el número de comidas por día
        // - users: Dentro de users pueden venir varios usuarios, cada uno con los siguientes datos:
        //     - age: edad
        //     - likes: comidas o ingredientes que le gustan
        //     - unlikes: comidas o ingredientes que no le gustan
        //     - exercises: ejercicios que realiza el usuario semanalmente, incluyendo:
        //         - name: nombre del ejercicio
        //         - times_per_week: veces por semana que lo practica
        //         - session_duration: duración de la sesión
        //         - intensity: intesidad, que puede ser low, medium o high
        // Dependiendo de las características de los usuarios, como la edad, de lo que le gusta, no le gusta y los ejercicios que realizan, podrás generar un planning acorde a todo ello.
        // Por poner un ejemplo, si un usuario realiza mucho ejercicio necesitará comer alimentos con más aporte calórico.';
        
        $introduction = 'Quiero que generes un planning semanal de comidas. Para ello te pasaré un json con información de uno o varios usuarios.';        

        $planningSettings = PlanningSettings::find(1);
        $dataForPlanning = (new PlanningPrepareDataService($planningSettings))->getData();

        // dd($dataForPlanning);

        $dataForPlanning = 'Información del usuario: ' . json_encode($dataForPlanning);
        $schemaString = 'Este es el schema del json que espero como respuesta: {"$schema":"https://json-schema.org/draft/2020-12/schema","type":"object","properties":{"mealPlan":{"type":"object","properties":{"weekDays":{"type":"array","items":{"type":"object","properties":{"day":{"type":"string"},"turns":{"type":"array","items":{"type":"object","properties":{"name":{"type":"string"},"meals":{"type":"array","items":{"type":"object","properties":{"name":{"type":"string"},"calories":{"type":"integer"},"recipe":{"type":"array","items":{"type":"string"}}},"required":["name","calories","recipe"]}}},"required":["name","meals"]}}},"required":["day","turns"]}}},"required":["weekDays","additionalNotes"]}},"required":["mealPlan"]}';
        $onlyJsonOutput = 'La salida de tu respuesta debe ser en formato JSON.';

        $prompt =  $introduction . ' - ' . $dataForPlanning . ' - ' . $schemaString;

        return $prompt;
    }

    private function getPlanningFromRespose($content)
    {
        // Extraer el JSON del plan de comidas del contenido
        $mealPlanJson = $this->extractJsonFromText($content);

        if (!$mealPlanJson) {
            throw new Exception("No se pudo encontrar el JSON del plan de comidas en el texto proporcionado");
        }

        $cleanedJson = $this->cleanAndDecodeJson($mealPlanJson);

        // Intentar decodificar el JSON del plan de comidas
        $mealPlan = json_decode($cleanedJson, true, 512, JSON_INVALID_UTF8_IGNORE);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al decodificar JSON: " . json_last_error_msg() . "\nJSON problemático: " . $cleanedJson);
        }

        // Asegurarse de que la estructura es correcta
        if (!isset($mealPlan['mealPlan'])) {
            $mealPlan = ['mealPlan' => $mealPlan];
        }

        if (!isset($mealPlan['mealPlan']['weekDays'])) {
            $mealPlan['mealPlan']['weekDays'] = [];
        }

        if (!isset($mealPlan['mealPlan']['additionalNotes'])) {
            $mealPlan['mealPlan']['additionalNotes'] = "";
        }

        return $mealPlan;
    }


    private function cleanAndDecodeJson($jsonString)
    {
        $jsonString = preg_replace('/[^\P{C}\n]+/u', '', $jsonString);

        $replacements = [
            'á' => 'á',
            'é' => 'é',
            'í' => 'í',
            'ó' => 'ó',
            'ú' => 'ú',
            'ñ' => 'ñ',
            'ü' => 'ü',
            'Á' => 'Á',
            'É' => 'É',
            'Í' => 'Í',
            'Ó' => 'Ó',
            'Ú' => 'Ú',
            'Ñ' => 'Ñ',
            'Ü' => 'Ü'
        ];
        $jsonString = strtr($jsonString, $replacements);

        $jsonString = preg_replace('/\/\/.*/', '', $jsonString);
        $jsonString = $this->removeExtraCommas($jsonString);

        $jsonString = rtrim($jsonString, ",\n\r\t ");
        if (substr($jsonString, -1) !== '}') {
            $jsonString .= '}';
        }

        return $jsonString;
    }

    private function removeExtraCommas($jsonString)
    {
        $jsonString = preg_replace('/,\s*\]/', ']', $jsonString);
        $jsonString = preg_replace('/,\s*\}/', '}', $jsonString);
        return $jsonString;
    }

    private function extractJsonFromText($text)
    {
        if (preg_match('/```json\s*(.*?)\s*```/s', $text, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function updateMealOrder($data)
    {
        // $this->data = $data;
        // dd($data);
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }

    protected $listeners = [
        'elementDragStart' => 'handleDragStart',
        'elementDragEnter' => 'handleDragEnter',
        'elementDragStop' => 'handleDragStop',
    ];

    public function handleDragStart($event)
    {
        // Lógica para manejar el evento dragstart
    }

    public function handleDragEnter($event)
    {
        // Lógica para manejar el evento dragenter
    }

    public function handleDragStop($event)
    {
        // Lógica para manejar el evento dragstop
    }
}
