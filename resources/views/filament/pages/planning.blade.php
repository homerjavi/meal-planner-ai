<x-filament-panels::page>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    @assets
        <script>
        </script>

        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js" defer></script>
    @endassets
    <div wire:loading>
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center">
            <span class="loader"></span>
        </div>
    </div>
    <section class="py-4">
        <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Planning
                </h2>
                <p class="mt-2 text-xl text-purple-200">
                    Organiza tus comidas de manera sencilla y rápida.
                </p>
            </div>
            
            <div class="flex mb-12">
                <div class="w-1/6"></div>
                <div class="flex w-4/6 items-center max-w-xl mx-auto">   
                    <label for="voice-search" class="sr-only">Generar nuevo planning</label>
                    <div class="relative flex-grow">
                        <input wire:model='extraIndicationsForIA' type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-6 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="¿Qué te apetece esta semana?" />
                    </div>
                    <button wire:click="generatePlanning" class="flex grow-1 items-center px-2 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 h-[42px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd" />
                        </svg>
                        <span class="whitespace-nowrap">Generar planning</span>
                    </button>
                </div>
                <div class="w-1/6 relative group flex justify-end">
                    <button
                        wire:click="savePlanning"
                        class="p-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200"
                        aria-label="Guardar planning"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                    </button>
                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 bg-gray-800 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Guardar planning
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @isset($data['mealPlan']['weekDays'])
                    @foreach ($data['mealPlan']['weekDays'] as $dayData)
                        <x-day-card :dayData="$dayData" />
                    @endforeach
                    
                @endisset
            </div>
        </div>
    </section>

    <script>
        window.showLoading = function() {
            Livewire.emit('toggleLoading', true);
        }
    
        window.hideLoading = function() {
            Livewire.emit('toggleLoading', false);
        }
    </script>
</x-filament-panels::page>
