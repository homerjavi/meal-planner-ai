<?php

namespace App\Filament\Services\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

class MemberForm
{
    public static function form(): array
    {
        return
            [
                Grid::make([
                    'default' => 1,
                    'sm' => 2,
                ])->schema(
                    [
                        TextInput::make('name')
                            ->label('messages.name')
                            ->translateLabel()
                            ->required(),
                        TextInput::make('last_name')
                            ->label('messages.last_name')
                            ->translateLabel(),
                        TextInput::make('email')
                            ->label('messages.email')
                            ->translateLabel()
                            ->email(),
                        DatePicker::make('birthday')
                            ->label('messages.birthday')
                            ->translateLabel()
                            ->required(),
                    ]
                ),
            ];
    }
}
