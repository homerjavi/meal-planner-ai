<x-filament-panels::page>
    @assets
        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js" defer></script>
    @endassets
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Planning
                </h2>
                <p class="mt-4 text-xl text-purple-200">
                    Organiza tus comidas de manera sencilla y rápida.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($mealsPerDayAndHours as $mealsDay)
                    <x-day-card :mealsDay="$mealsDay" />
                @endforeach
                {{-- <ul wire:sortable="updateMealOrder">
                    @forelse ($mealsPerDayAndHours[0]['hours'][0]['meals'] as $meal)
                        <li wire:sortable.handle wire:sortable.item="{{ $meal['id'] }}"
                            wire:key="meal-{{ $meal['id'] }}" class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" color="primary" />
                            <span class="mx-2">{{ $meal['name'] }}</span>
                        </li>
                    @empty
                        <span>No hay nada</span>
                    @endforelse
                </ul> --}}
            </div>
        </div>
    </section>

    {{-- @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script> --}}

</x-filament-panels::page>
