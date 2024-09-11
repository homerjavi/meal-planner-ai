<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanningResource\Pages;
use App\Models\Planning;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

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
                    TextColumn::make('data')
                    ->formatStateUsing(function ($state) {
                        if (is_string($state)) {
                            $data = json_decode($state, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                // El estado es una cadena JSON válida
                                return Str::limit(json_encode($data, JSON_PRETTY_PRINT), 50);
                            }
                        } elseif (is_array($state)) {
                            // El estado ya es un array (posiblemente ya decodificado)
                            return Str::limit(json_encode($state, JSON_PRETTY_PRINT), 50);
                        }
                        // Si no es JSON ni array, devolver el estado original
                        return $state;
                    })
                    ->sortable()
                    ->searchable()
                    ->tooltip(function ($state) {
                        if (is_string($state)) {
                            $data = json_decode($state, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                return json_encode($data, JSON_PRETTY_PRINT);
                            }
                        } elseif (is_array($state)) {
                            return json_encode($state, JSON_PRETTY_PRINT);
                        }
                        return $state;
                    }),
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
