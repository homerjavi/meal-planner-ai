<div class="bg-white dark:bg-slate-800 rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl relative overflow-hidden">
    <div class="absolute top-0 right-0 m-4">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
            {{ trans('messages.change') }}
        </span>
    </div>
    <div class="mb-8">
        <h3 class="text-2xl font-semibold text-white">{{ $dayData['day'] }}</h3>
    </div>
    <div class="mb-8 space-y-4 text-purple-200">
        @foreach ($dayData['turns'] as $key => $turn)
            {{-- @dump($key, $turn) --}}
            {{-- @dd($turn) --}}
            {{-- @livewire('meal-time', ['turn' => $turn], key('meal-time-' . $key)) --}}
            <livewire:meal-time :turn="$turn" wire:key="meal-time-{{ $dayData['day'] }}-{{ $key }}" />
            {{-- <livewire:meal-time :turn="$turn"
                wire:key="meal-time-{{ $dayData['day'] }}-{{ $key }}-{{ $loop->index }}" /> --}}
        @endforeach
        <a href="#"
            class="block w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
            Añadir
        </a>
    </div>

</div>
