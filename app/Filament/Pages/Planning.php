<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Planning extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.planning';

    public array $mealsPerDayAndHours = [];

    public function __construct()
    {
        $this->mealsPerDayAndHours = [
            [
                'name' => 'Lunes',
                'hours' => [
                    [
                        'name' => 'breakfast',
                        'icon' => 'heroicon-o-cloud',
                        'meals' => [
                            [
                                'id' => '1',
                                'name' => 'Zumo naranja',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '2',
                                'name' => 'Tostada con aguacate',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                    [
                        'name' => 'lunch',
                        'icon' => 'heroicon-o-sun',
                        'meals' => [
                            [
                                'id' => '3',
                                'name' => 'Ensalada de quinoa',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '4',
                                'name' => 'Sopa de verduras',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                    [
                        'name' => 'dinner',
                        'icon' => 'heroicon-o-moon',
                        'meals' => [
                            [
                                'id' => '5',
                                'name' => 'Pasta con tomate',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '6',
                                'name' => 'Ensalada de espinacas',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                ],
            ],
            [
                'name' => 'Martes',
                'hours' => [
                    [
                        'name' => 'breakfast',
                        'icon' => 'heroicon-o-cloud',
                        'meals' => [
                            [
                                'id' => '7',
                                'name' => 'Zumo naranja',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '8',
                                'name' => 'Tostada con aguacate',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                    [
                        'name' => 'lunch',
                        'icon' => 'heroicon-o-sun',
                        'meals' => [
                            [
                                'id' => '9',
                                'name' => 'Ensalada de quinoa',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '10',
                                'name' => 'Sopa de verduras',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                    [
                        'name' => 'dinner',
                        'icon' => 'heroicon-o-moon',
                        'meals' => [
                            [
                                'id' => '11',
                                'name' => 'Pasta con tomate',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '12',
                                'name' => 'Ensalada de espinacas',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                ],
            ],
            [
                'name' => 'Miércoles',
                'hours' => [
                    [
                        'name' => 'breakfast',
                        'icon' => 'heroicon-o-cloud',
                        'meals' => [
                            [
                                'id' => '13',
                                'name' => 'Zumo naranja',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '14',
                                'name' => 'Tostada con aguacate',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                    [
                        'name' => 'lunch',
                        'icon' => 'heroicon-o-sun',
                        'meals' => [
                            [
                                'id' => '15',
                                'name' => 'Ensalada de quinoa',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                            [
                                'id' => '16',
                                'name' => 'Sopa de verduras',
                                'description' => 'Start your day with a healthy breakfast.',
                            ],
                        ]
                    ],
                ],
            ],
        ];
    }

    public function updateMealOrder($mealsPerDayAndHours)
    {
        // $this->mealsPerDayAndHours = $mealsPerDayAndHours;
        dd($mealsPerDayAndHours);
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }
}
