<x-filament-panels::page>
    <section class=py-12">
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
                <x-day-card day="Lunes" />
                <!-- Basic Plan -->
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        {{-- <li class="flex items">
                            <div class="text-divider w-full">Comida</div>
                        </li> --}}
                        <div class="bg-white bg-opacity-5 relative p-4 rounded-xl shadow-lg">
                            {{-- <h2 class="text-2xl font-bold mb-2">Almuerzo</h2> --}}
                            <div class="absolute top-0 right-0 m-4">
                                {{-- <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    Almuerzo
                                </span> --}}
                                {{-- <x-filament::icon-button icon="heroicon-o-cloud" wire:click="openNewUserModal"
                                    color="primary" label="New label" /> --}}
                                <x-filament::icon-button icon="heroicon-o-bell-snooze" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                            </div>
                            <li class="flex items-center">
                                <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                                <span class="mx-2">Zumo de naranja</span>
                            </li>
                            <li class="flex items-center">
                                <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                                <span class="mx-2">Tostadas con aguacate</span>
                            </li>
                        </div>
                        <div class="bg-white bg-opacity-5 relative p-4 rounded-xl shadow-lg">
                            {{-- <h2 class="text-2xl font-bold mb-2">Almuerzo</h2> --}}
                            <div class="absolute top-0 right-0 m-4">
                                {{-- <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    Almuerzo
                                </span> --}}
                                <x-filament::icon-button icon="heroicon-o-sun" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                            </div>
                            <li class="flex items-center">
                                <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                                <span class="mx-2">Ensalada de arroz</span>
                            </li>
                            <li class="flex items-center">
                                <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                                <span class="mx-2">Salmón al horno</span>
                            </li>
                        </div>
                        {{-- <li class="flex items">
                            <div class="text-divider w-full" style="margin-top: 1rem;">Cena</div>
                        </li> --}}
                        <div class="bg-white bg-opacity-5 relative p-4 rounded-xl shadow-lg">
                            {{-- <h2 class="text-2xl font-bold mb-2">Almuerzo</h2> --}}
                            {{-- <div class="w-full flex justify-start mb-2">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    Cena
                                </span>
                            </div> --}}
                            <div class="absolute top-0 right-0 m-4">
                                {{-- <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    Almuerzo
                                </span> --}}
                                <x-filament::icon-button icon="heroicon-o-moon" wire:click="openNewUserModal"
                                    color="primary" label="New label" class="absolute" />
                            </div>
                            <li class="flex items-center">
                                <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                                <span class="mx-2">Crema de verduras</span>
                            </li>
                            <li class="flex items-center">
                                <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                    color="primary" label="New label" />
                                <span class="mx-2">Tortilla francesa</span>
                            </li>
                        </div>
                        {{-- <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span> --}}
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Añadir
                    </a>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Ensalada de arroz</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Salmón al horno</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Editar
                    </a>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Ensalada de arroz</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Salmón al horno</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Editar
                    </a>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Ensalada de arroz</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Salmón al horno</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Editar
                    </a>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Ensalada de arroz</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Salmón al horno</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Editar
                    </a>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Ensalada de arroz</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Salmón al horno</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Editar
                    </a>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 m-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Cambiar
                        </span>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold text-white">Lunes</h3>
                        {{-- <p class="mt-4 text-purple-200">Perfect for individuals and small teams.</p> --}}
                    </div>
                    {{-- <div class="mb-8">
                    <span class="text-5xl font-extrabold text-white">$49</span>
                    <span class="text-xl font-medium text-purple-200">/mo</span>
                </div> --}}
                    <ul class="mb-8 space-y-4 text-purple-200">
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Ensalada de arroz</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Salmón al horno</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Crema de verduras</span>
                        </li>
                        <li class="flex items-center">
                            <x-filament::icon-button icon="heroicon-o-bars-3" wire:click="openNewUserModal"
                                color="primary" label="New label" />
                            <span class="mx-2">Tortilla francesa</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                        Editar
                    </a>
                </div>

            </div>
        </div>
    </section>
</x-filament-panels::page>
