<div>
    @if($isLoading)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-blue-500"></div>
                <p class="mt-4 text-center text-gray-700">Cargando...</p>
            </div>
        </div>
    @endif
</div>