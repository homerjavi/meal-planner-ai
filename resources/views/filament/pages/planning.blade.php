<x-filament-panels::page>
    
    @assets
        <script>
            // document.addEventListener('livewire:initialized', function() {
            //     // debugger;
            //     function test() {
            //         console.log('test');
            //     }

            //     function initializeSortableItems() {
            //         console.log("initializeSortableItems");
            //         const items = document.querySelectorAll('.sortable-item');
            //         items.forEach((item) => {
            //             item.addEventListener('dragstart', () => {
            //                 item.classList.add('sortable-item-dragging');
            //                 console.log('dragstart');
            //             });
            //             item.addEventListener('dragend', () => {
            //                 item.classList.remove('sortable-item-dragging');
            //                 console.log('dragend');
            //             });
            //         });
            //     }

            //     // Initialize sortable items on load
            //     initializeSortableItems();

            //     // Reinitialize sortable items after Livewire updates
            //     Livewire.hook('message.processed', (message, component) => {
            //         console.log('message.processed');
            //         initializeSortableItems();
            //     });
            // });
        </script>

        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js" defer></script>
        {{-- <style>
            .sortable-item-dragging {
                border: 2px solid blue;
                background-color: #2d3748;
                /* bg-gray-800 */
                color: red;
            }
        </style> --}}
    @endassets
    <div wire:loading>
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-blue-500"></div>
                <p class="mt-4 text-center text-gray-700">Generando nuevo planning</p>
            </div>
        </div>
    </div>
    <section class="py-12">
        <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Planning
                </h2>
                <p class="mt-4 text-xl text-purple-200">
                    Organiza tus comidas de manera sencilla y rápida.
                </p>
            </div>
            <button wire:click="generatePlanning" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-3 rounded">
                Generar nuevo planning
            </button>

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
