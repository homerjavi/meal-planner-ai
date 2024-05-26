<?php

namespace App\Livewire\Users;

use App\Enums\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class EditUser extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public User $record;

    public function mount(): void
    {
        $this->record = auth()->user();
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('last_name')
                                    ->maxLength(255),


                                Forms\Components\DatePicker::make('birthday'),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                    ->maxLength(255),
                            ]),

                    ])->columnSpan(2),

                Forms\Components\Group::make()
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
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->revealable()
                                    ->nullable()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('password_confirmation')
                                    ->password()
                                    ->revealable()
                                    ->same('password')
                                    ->nullable()
                                    ->maxLength(255),
                            ]),
                        // Section::make()
                        //     ->schema([
                        //         Forms\Components\Select::make('role')
                        //             ->options(Role::class)
                        //             ->disabled(fn (Get $get) => $get('role') !== Role::Admin->value)
                        //             ->required(),
                        //     ])
                    ])
                    ->columns(1)
                    ->columnSpan(1),



                Actions::make([
                    Action::make('save')
                        ->label('messages.save')
                        ->translateLabel()
                        ->action(function () {
                            $this->save();
                        }),
                ]),
            ])
            ->columns(3)
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {

        $data = $this->form->getState();

        if ($data['password'] && Hash::check($data['password'], $this->record->password)) {
            unset($data['password']);
        }

        // dd($data);
        $this->record->update($data);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.users.edit-user');
    }
}
