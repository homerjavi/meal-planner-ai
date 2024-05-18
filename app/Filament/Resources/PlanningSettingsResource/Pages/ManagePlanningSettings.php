<?php

namespace App\Filament\Resources\PlanningSettingsResource\Pages;

use App\Filament\Resources\PlanningSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePlanningSettings extends ManageRecords
{
    protected static string $resource = PlanningSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
