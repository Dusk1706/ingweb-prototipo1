<form action="{{ route('guardar-en-caja') }}" method="POST" id="guardarenCaja" class="block">
    @csrf
    <div class="mt-10 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            <div class="md:col-span-2">
                <h4 class="text-lg font-semibold text-amber-600 dark:text-amber-300 mb-4 flex items-center">
                    <x-svg-icon src="icono-monedas.svg" class="w-6 h-6 mr-2" />
                    Denominaciones Menores
                </h4>
                <div class="space-y-3">
                    @foreach ($coins as $coin)
                        <x-denomination-input :denomination="$coin" :value="$denomDetalle[$coin] ?? 0" />
                    @endforeach
                </div>
            </div>

            <div class="md:col-span-3">
                <h4 class="text-lg font-semibold text-green-600 dark:text-green-300 mb-4 flex items-center">
                    <x-svg-icon src="icono-billete.svg" class="w-6 h-6 mr-2" />
                    Denominaciones Mayores
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach ($bills as $bill)
                        <x-denomination-input :denomination="$bill" :value="$denomDetalle[$bill] ?? 0" :large="true" />
                    @endforeach
                </div>
            </div>

        </div>

        <div class="mt-8">
            <button type="submit"
                class="w-full p-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:shadow transition transform hover:scale-105">
                Guardar en Caja
            </button>
        </div>
    </div>
</form>
