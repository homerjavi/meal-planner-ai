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

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($mealsPerDayAndHours as $mealsDay)
                    <x-day-card :mealsDay="$mealsDay" />
                @endforeach
            </div>
        </div>
    </section>
</x-filament-panels::page>
