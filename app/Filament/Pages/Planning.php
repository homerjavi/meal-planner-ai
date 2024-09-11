<?php

namespace App\Filament\Pages;

use App\Models\Planning as ModelsPlanning;
use App\Models\PlanningSettings;
use App\Services\AnthropicService;
use App\Services\PlanningPrepareDataService;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class Planning extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.planning';

    protected string $jsonData;
    public array $data = [];
    public bool $isLoading = true;
    public string $extraIndicationsForIA = '';

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
        // $this->isLoading = true;
        // dump(2);
        // sleep(3);
        // dump(3);
        $anthropicService = new AnthropicService();
        $prompt = $this->generatePrompt();
        if ($this->extraIndicationsForIA) {
            $prompt = $this->extraIndicationsForIA . ' La salida debe ser con el mismo frormato que el ejemplo inicial.';
        }
        // dd($prompt);

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

        $this->data = $formatedResponse;
    }



    private function generatePrompt()
    {
        $introduction = 'Quiero que generes un planning semanal de comidas. Para ello te pasaré un json con información de uno o varios usuarios.';

        $planningSettings = PlanningSettings::find(1);
        $dataForPlanning = (new PlanningPrepareDataService($planningSettings))->getData();

        $dataForPlanning = 'Información del usuario: ' . json_encode($dataForPlanning);
        $schemaString = 'Este es el schema del json que espero como respuesta: {"$schema":"https://json-schema.org/draft/2020-12/schema","type":"object","properties":{"mealPlan":{"type":"object","properties":{"weekDays":{"type":"array","items":{"type":"object","properties":{"day":{"type":"string"},"turns":{"type":"array","items":{"type":"object","properties":{"name":{"type":"string"},"meals":{"type":"array","items":{"type":"object","properties":{"name":{"type":"string"},"calories":{"type":"integer"},"recipe":{"type":"array","items":{"type":"string"}}},"required":["name","calories","recipe"]}}},"required":["name","meals"]}}},"required":["day","turns"]}}},"required":["weekDays","additionalNotes"]}},"required":["mealPlan"]}';
        $onlyJsonOutput = 'La salida de tu respuesta debe ser en formato JSON.';

        $extraIndicationsForIA = 'Info adicional a tener en cuenta muy importante: ' . $this->extraIndicationsForIA;

        $prompt =  $onlyJsonOutput
            . ' - ' . $introduction
            . ' - ' . $extraIndicationsForIA
            . ' - ' . $dataForPlanning
            . ' - ' . $schemaString;

        Log::info('Prompt: ' . $prompt);
        return $prompt;
    }

    private function getPlanningFromRespose($content)
    {
        $mealPlan = json_decode($content, true);

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

    public function savePlanning()
    {
        $this->isLoading = true;

        $existingPlanning = ModelsPlanning::where('user_id', auth()->id())
            ->where('family_id', auth()->user()->family_id)
            ->where('date_start', now()->startOfWeek()->format('Y-m-d'))
            ->where('date_end', now()->endOfWeek()->format('Y-m-d'))
            ->first();

        // dd($existingPlanning);XX

        if ($existingPlanning) {
            // TODO: Aquí necesitas mostrar un SweetAlert al frontend para confirmar si se desea sobreescribir el planning existente
            // Aquí necesitas enviar una respuesta al frontend para mostrar el SweetAlert
            // Esto podría ser mediante una sesión flash o una respuesta específica que tu JS pueda manejar
        } else {
            // Si no existe, crea el nuevo registro directamente
            ModelsPlanning::create([
                'user_id' => auth()->id(),
                'family_id' => auth()->user()->family_id,
                'date_start' => now()->startOfWeek(),
                'date_end' => now()->endOfWeek(),
                'is_ia_generated' => true,
                'is_favorite' => false,
                'data' => json_encode($this->data),
            ]);
        }

        $this->isLoading = false;
    }


    // private function cleanAndDecodeJson($jsonString)
    // {
    //     $jsonString = preg_replace('/[^\P{C}\n]+/u', '', $jsonString);

    //     $replacements = [
    //         'á' => 'á',
    //         'é' => 'é',
    //         'í' => 'í',
    //         'ó' => 'ó',
    //         'ú' => 'ú',
    //         'ñ' => 'ñ',
    //         'ü' => 'ü',
    //         'Á' => 'Á',
    //         'É' => 'É',
    //         'Í' => 'Í',
    //         'Ó' => 'Ó',
    //         'Ú' => 'Ú',
    //         'Ñ' => 'Ñ',
    //         'Ü' => 'Ü'
    //     ];
    //     $jsonString = strtr($jsonString, $replacements);

    //     $jsonString = preg_replace('/\/\/.*/', '', $jsonString);
    //     $jsonString = $this->removeExtraCommas($jsonString);

    //     $jsonString = rtrim($jsonString, ",\n\r\t ");
    //     if (substr($jsonString, -1) !== '}') {
    //         $jsonString .= '}';
    //     }

    //     return $jsonString;
    // }

    // private function removeExtraCommas($jsonString)
    // {
    //     $jsonString = preg_replace('/,\s*\]/', ']', $jsonString);
    //     $jsonString = preg_replace('/,\s*\}/', '}', $jsonString);
    //     return $jsonString;
    // }

    // private function extractJsonFromText($text)
    // {
    //     if (preg_match('/```json\s*(.*?)\s*```/s', $text, $matches)) {
    //         return $matches[1];
    //     }
    //     return null;
    // }

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
