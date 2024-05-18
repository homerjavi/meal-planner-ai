<?php

namespace App\Filament\Resources\UnlikeResource\Pages;

use App\Filament\Resources\UnlikeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnlike extends EditRecord
{
    protected static string $resource = UnlikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
