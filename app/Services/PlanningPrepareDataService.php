<?php

namespace App\Services;

use App\Models\PlanningSettings;

class PlanningPrepareDataService
{
    public function __construct(private PlanningSettings $planningSettings)
    {
        
    }   

    public function getData(): array
    {
        // Si es de familia recorrer todos los miembros

        $data = [
            'weekDays' => $this->planningSettings->days,
            'numberOfMealsPerDay' => $this->planningSettings->number_of_meals_per_day,
            'foodType' => $this->planningSettings->food_type,
            'users' => $this->getUsersData(),
        ];

        return $data;
    }

    private function getUsersData(): array
    {
        $usersData = [];

        foreach ($this->planningSettings->getUsers() as $user) {
            $usersData[] = [
                'id' => $user->id,
                'age' => $user->birthday?->age,
                'likes' => $user->likes->pluck('name')->toArray(),
                'unlikes' => $user->unlikes->pluck('name')->toArray(),
                'exercises' => $user->exercises()->select('name', 'times_per_week', 'session_duration', 'intensity')->get()->toArray(),
            ];
        }

        return $usersData;
    }
}