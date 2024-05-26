<x-filament-panels::page>
    {{-- @livewire('users.edit-user') --}}
    {{-- @livewire('users.edit-user') --}}
    <x-filament-panels::form wire:submit="update">
        {{-- <x-filament-panels::form> --}}
        {{ $this->form }}
        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>
