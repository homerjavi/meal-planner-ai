<div class="bg-white bg-opacity-5 relative p-4 rounded-xl shadow-lg">
    <div class="absolute top-0 right-0 m-4">
        <x-filament::icon-button icon="{{ $mealHour['icon'] }}" color="primary" />
    </div>
    <div wire:sortable="updateOrder">
        @forelse ($mealHour['meals'] as $meal)
            <div wire:sortable.handle wire:sortable.item="{{ $meal['id'] }}" wire:key="meal-{{ $meal['id'] }}"
                class="sortable-item flex items-center hover:bg-gray-800 hover:text-sky-400 transition ease-in-out duration-150">
                <span class="mx-2">{{ $meal['name'] }}</span>
            </div>
        @empty
            <span>No hay nada</span>
        @endforelse
    </div>
</div>
