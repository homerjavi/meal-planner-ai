<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnlikeResource\Pages;
use App\Models\Unlike;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnlikeResource extends Resource
{
    protected static ?string $model = Unlike::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-down';
    
    protected static ?int $navigationSort = 50;

    private static function formFields(): array
    {
        return [
            TextInput::make('name')
                ->label('messages.name')
                ->translateLabel()
                ->required(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::formFields());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->hiddenLabel(),

                Tables\Actions\DeleteAction::make()
                    ->hiddenLabel(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnlikes::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.unlikes');
    }

    public static function getLabel(): ?string
    {
        return __('messages.unlike');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.unlikes');
    }
}
