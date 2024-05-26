<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile';

    public ?array $data = [];

    public User $record;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(): void
    {
        $this->record = auth()->user();
        // dd($this->record->attributesToArray());
        $this->form->fill($this->record->attributesToArray());
        // dd($this->form->getState(), $this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('last_name')
                                    ->maxLength(255),


                                DatePicker::make('birthday'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                    ->maxLength(255),
                            ]),

                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                FileUpload::make('avatar')
                                    ->avatar()
                                    ->imageEditor()
                                    ->extraAttributes(['class' => 'col-span-full']),
                            ])->columnSpanFull(),
                        Section::make()
                            ->schema([
                                TextInput::make('password')
                                    ->password()
                                    ->revealable()
                                    ->nullable()
                                    ->maxLength(255),
                                TextInput::make('password_confirmation')
                                    ->password()
                                    ->revealable()
                                    ->same('password')
                                    ->nullable()
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columns(1)
                    ->columnSpan(1),
            ])
            ->columns(3)
            ->statePath('data')
            ->model($this->record);
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('Update')
                ->label('messages.update')
                ->translateLabel()
                // ->action(fn () => $this->update())
                ->submit('update'),
        ];
    }

    public function update(): void
    {
        $data = $this->form->getState();

        if ($data['password'] && Hash::check($data['password'], $this->record->password)) {
            unset($data['password']);
        }

        $this->record->update($data);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
