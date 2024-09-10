<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanningSettingsResource\Pages;
use App\Filament\Resources\PlanningSettingsResource\RelationManagers;
use App\Models\PlanningSettings;
use App\Models\User;
use Faker\Core\Number;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PlanningSettingsResource extends Resource
{
    protected static ?string $model = PlanningSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
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
                    ->live()
                    ->required()
                    ->disabled(!auth()->user()->family_id)
                    ->helperText(fn() => !auth()->user()->family_id ? 'No puedes seleccionar "Family" si no tienes una familia asignada' : null),
                TextInput::make('food_type')
                    ->label('messages.food_type')
                    ->translateLabel()
                    ->placeholder('Ejemplo: Saludable, Vegetariano, etc.'),
                TextInput::make('number_of_meals_per_day')
                    ->label('messages.number_of_meals_per_day')
                    ->translateLabel()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10)
                    ->default(3)
                    ->required(),
                ToggleButtons::make('family_members')
                    ->label('messages.family_members')
                    ->translateLabel()
                    ->inline()
                    ->options(fn () => auth()->user()->family->users->pluck('name', 'id')->toArray())
                    ->multiple()
                    ->columnSpanFull()
                    ->hidden(fn (Get $get) => $get('planning_type') !== 'family')
                    ->required(),
                ToggleButtons::make('days')
                    ->inline()
                    ->options(getWeekDays())
                    ->default(array_keys(getWeekDays()))
                    ->multiple()
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('additional_info')
                    ->label('messages.additional_info')
                    ->translateLabel()
                    ->columnSpanFull()
                    ->rows(5),
            ])->columns(3);
    }

    protected function handleRecordCreation(array $data): Model
    {
        if ($data['planning_type'] === 'family') {
            $data['family_id'] = auth()->user()->family_id;
        }
        return static::getModel()::create($data);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['planning_type'] === 'family') {
            $data['family_id'] = auth()->user()->family_id;
        }
        $record->update($data);
        return $record;
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('food_type')
                    ->label('messages.food_type')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('days')
                    ->label('messages.days')
                    ->translateLabel()
                    ->badge()
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        return __('messages.' . $state);
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('family_members')
                    ->label('messages.family_members')
                    ->translateLabel()
                    ->badge()
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        return User::find($state)->name;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_meals_per_day')
                    ->label('messages.number_of_meals_per_day')
                    ->translateLabel()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('additional_info')
                    ->label('messages.additional_info')
                    ->translateLabel()
                    ->limit(200)
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
