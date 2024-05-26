<?php

namespace App\Filament\Pages;

use App\Filament\Services\Forms\MemberForm;
use App\Models\User;
use Faker\Provider\ar_EG\Text;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;

class Family extends Page implements HasForms, HasTable, HasActions
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.family';

    public ?array $data = [];

    public $isEdit = false;

    public $family = null;
    public $familyName = '';

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return '';
    }

    public function mount(): void
    {
        $this->family = auth()->user()->family;
        $this->familyName = $this->family?->name;
        $this->form->fill($this->family->attributesToArray());
        $this->getTitle();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->hiddenLabel()
                    ->placeholder('Ejemplo: Familia Pérez')
                    ->required(),
            ])
            ->statePath('data')
            ->model($this->family);
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('Update')
                ->label('messages.update')
                ->translateLabel()
                ->submit('update'),
        ];
    }

    public function update()
    {
        $data = $this->form->getState();
        $this->validate();
        $this->family->update($data);
        $this->isEdit = false;

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->whereFamilyId(auth()->user()->family_id))
            ->columns([
                TextColumn::make('name')
                    ->label('messages.name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('last_name')
                    ->label('messages.last_name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('messages.email')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('birthday')
                    ->label('messages.birthday')
                    ->translateLabel()
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make()
                    ->hiddenLabel()
                    ->form(MemberForm::form()),

                DeleteAction::make()
                    ->hiddenLabel(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('messages.addMember')
                    ->translateLabel()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['family_id'] = auth()->user()->family_id;

                        return $data;
                    })
                    ->form(MemberForm::form())
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.family');
    }

    public static function getLabel(): ?string
    {
        return __('messages.family');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.families');
    }
}
