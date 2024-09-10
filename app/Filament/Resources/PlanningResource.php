<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanningResource\Pages;
use App\Models\Planning;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlanningResource extends Resource
{
    protected static ?string $model = Planning::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 60;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_end')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_ia_generated')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_favorite')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // public static function getRelations(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(mixed $record): bool
    {
        return false;
    }

    public static function canDelete(mixed $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlannings::route('/'),
            // 'create' => Pages\CreatePlanning::route('/create'),
            // 'edit' => Pages\EditPlanning::route('/{record}/edit'),
        ];
    }
}
