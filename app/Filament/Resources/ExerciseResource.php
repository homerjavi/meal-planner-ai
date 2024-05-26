<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'fas-person-snowboarding';
    protected static ?int $navigationSort = 60;

    private static function formFields(): array
    {
        return [
            Split::make([
                Section::make([
                    TextInput::make('name')
                        ->label('messages.name')
                        ->translateLabel()
                        ->required(),
                    Textarea::make('description')
                        ->label('messages.description')
                        ->translateLabel()
                        ->rows(5),
                ]),
                Section::make([
                    TextInput::make('times_per_week')
                        ->label('messages.times_per_week')
                        ->translateLabel()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(7)
                        ->default(3)
                        ->columns(1),
                    Select::make('intensity')
                        ->label('messages.intensity')
                        ->translateLabel()
                        ->native(false)
                        ->options(Exercise::getTranslatedIntensities())
                        ->default(array_key_first(Exercise::INTENSITY_OPTIONS))
                        ->columns(2),
                    TextInput::make('session_duration')
                        ->label('messages.session_duration')
                        ->translateLabel()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(600)
                        ->columns(2),
                ])->grow(false),
            ])->from('sm'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::formFields())->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('messages.name')
                    ->translateLabel()
                    ->description(fn (Exercise $record): string => strlen($record->description) > 20 ? substr($record->description, 0, 20) . '...' : $record->description ?? '', position: 'bottom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('times_per_week')
                    ->label('messages.times_per_week')
                    ->translateLabel()
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('intensity')
                    ->label('messages.intensity')
                    ->translateLabel()
                    ->formatStateUsing(function ($state) {
                        return __('messages.' . $state);
                    })
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('session_duration')
                    ->label('messages.session_duration')
                    ->translateLabel()
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
            ])
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
            'index' => Pages\ListExercises::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.exercises');
    }

    public static function getLabel(): ?string
    {
        return __('messages.exercise');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.exercises');
    }
}
