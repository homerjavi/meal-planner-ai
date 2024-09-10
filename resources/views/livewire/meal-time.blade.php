<div class="bg-white bg-opacity-5 relative p-4 rounded-xl shadow-lg">
    <div class="absolute top-0 right-0 m-4">
        <x-filament::icon-button icon="{{ $icons[$key] }}" color="primary" />
    </div>
    <div wire:sortable="updateOrder">
        @forelse ($turn['meals'] as $meal)
            {{-- <div wire:sortable.handle wire:sortable.item="{{ $meal['name'] }}" wire:key="meal-{{ $meal['name'] }}"
                class="sortable-item flex items-center hover:bg-gray-800 hover:text-sky-400 transition ease-in-out duration-150">
                <span class="mx-2">{{ $meal['name'] }}</span>
            </div> --}}
            <div x-data="{ showModal: false }" class="relative">
                <div class="flex flex-col bg-gray-800 text-gray-200 p-3 rounded-lg">
                    <div wire:sortable.handle wire:sortable.item="{{ $meal['name'] }}" wire:key="meal-{{ $meal['name'] }}"
                         class="sortable-item mb-2">
                        <span class="text-sm font-medium">{{ $meal['name'] }}</span>
                    </div>
                    <div class="flex items-center justify-between space-x-2 text-xs">
                        <span class="bg-indigo-500 text-white font-bold px-3 py-1 rounded-full transition duration-300 ease-in-out hover:bg-indigo-500">
                            {{ $meal['calories'] }} cal
                        </span>
                        <button @click.stop="showModal = true"
                                class="bg-indigo-500 text-white font-bold px-3 py-1 rounded-full cursor-pointer transition duration-300 ease-in-out hover:bg-indigo-500">
                            Receta
                        </button>
                    </div>
                </div>
            
                <!-- Modal (fuera del elemento arrastrable) -->
                <div x-show="showModal" 
                     class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-filter backdrop-blur-sm"></div>
                    <div class="relative bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full m-4">
                        <div class="bg-gray-800 px-6 py-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-200 mb-4" id="modal-headline">
                                Receta para {{ $meal['name'] }}
                            </h3>
                            <div class="mt-2">
                                <ul class="list-disc list-inside space-y-2">
                                    @foreach($meal['recipe'] as $step)
                                        <li class="text-sm text-gray-300">{{ $step }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="bg-gray-700 px-6 py-4 sm:flex sm:flex-row-reverse">
                            <button @click="showModal = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition duration-300 ease-in-out">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <span>No hay nada</span>
        @endforelse
    </div>
</div>
