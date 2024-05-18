<?php

namespace App\Filament\Resources\UnlikeResource\Pages;

use App\Filament\Resources\UnlikeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnlikes extends ListRecords
{
    protected static string $resource = UnlikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
