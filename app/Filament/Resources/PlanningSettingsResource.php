<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanningSettingsResource\Pages;
use App\Filament\Resources\PlanningSettingsResource\RelationManagers;
use App\Models\PlanningSettings;
use Faker\Core\Number;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanningSettingsResource extends Resource
{
    protected static ?string $model = PlanningSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('planning_type')
                    ->label('messages.planning_type')
                    ->translateLabel()
                    ->options(PlanningSettings::getTranslatedPlanningTypes())
                    ->default(array_key_first(PlanningSettings::PLANNING_TYPE))
                    ->native(false)
                    ->required(),
                TextInput::make('food_type')
                    ->label('messages.food_type')
                    ->translateLabel()
                    ->placeholder('Ejemplo: Saludable, Vegetariano, etc.'),
                Select::make('days')
                    ->label('messages.days')
                    ->translateLabel()
                    ->options(getWeekDays())
                    ->multiple()
                    ->default(array_keys(getWeekDays()))
                    ->required(),
                TextInput::make('number_of_meals_per_day')
                    ->label('messages.number_of_meals_per_day')
                    ->translateLabel()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10)
                    ->default(3)
                    ->required(),
                Textarea::make('additional_info')
                    ->label('messages.additional_info')
                    ->translateLabel()
                    ->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('planning_type')
                    ->label('messages.planning_type')
                    ->translateLabel()
                    ->formatStateUsing(function ($state) {
                        return __('messages.' . $state);
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('food_type')
                    ->label('messages.food_type')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('days')
                    ->label('messages.days')
                    ->translateLabel()
                    ->badge()
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        return __('messages.' . $state);
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_meals_per_day')
                    ->label('messages.number_of_meals_per_day')
                    ->translateLabel()
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('additional_info')
                    ->label('messages.additional_info')
                    ->translateLabel()
                    ->limit(200)
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePlanningSettings::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.planning_settings');
    }

    public static function getLabel(): ?string
    {
        return __('messages.planning_settings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.planning_settings');
    }
}
