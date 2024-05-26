<x-filament-panels::page>
    <div class="flex gap-sm">
        @if ($isEdit)
            <x-filament-panels::form wire:submit="update">
                <div class="flex items-center gap-4">
                    <h1>Familia <span class="text-primary-600">{{ $family->name }}</span></h1>
                    {{ $this->form }}
                    <x-filament-panels::form.actions :actions="$this->getFormActions()" />
                    <x-filament::icon-button icon="heroicon-o-x-mark" wire:click="$set('isEdit', false)" label="New label"
                        color="red" />
                </div>
            </x-filament-panels::form>
        @else
            <div>
                <div class="flex items-center gap-4">
                    <h1>Familia <span class="text-primary-600">{{ $family->name }}</span></h1>
                    <x-filament::icon-button icon="heroicon-o-pencil-square" wire:click="$set('isEdit', true)"
                        label="New label" />
                    {{-- <x-filament-panels::form.actions :actions="$this->getFormActions()" /> --}}
                </div>
            </div>
        @endif
    </div>
    <div>
        {{ $this->table }}
    </div>
</x-filament-panels::page>
