<div class="bg-white bg-opacity-5 relative p-4 rounded-xl shadow-lg">
    <div class="absolute top-0 right-0 m-4">
        <x-filament::icon-button icon="{{ $mealHour['icon'] }}" color="primary" />
    </div>
    <div wire:sortable="updateMealOrder">
        @forelse ($mealHour['meals'] as $meal)
            <div wire:sortable.item="{{ $meal['id'] }}" wire:key="meal-{{ $meal['id'] }}"
                class="flex items-center hover:border hover:border-1 hover:border-blue-500 hover:bg-gray-200 transition ease-in-out duration-150">
                <x-filament::icon-button wire:sortable.handle icon="heroicon-o-bars-3" color="primary" />
                <span class="mx-2">{{ $meal['name'] }}</span>
            </div>
        @empty
            <span>No hay nada</span>
        @endforelse
    </div>
</div>
