<div class="mt-10 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <x-denomination-group type="coins" title="Denominaciones Menores" icon="icono-monedas.svg" :denominations="$coins"
            :values="$denomDetalle" color="amber" />

        <x-denomination-group type="bills" title="Denominaciones Mayores" icon="icono-billete.svg" :denominations="$bills"
            :values="$denomDetalle" color="green" />
    </div>

    <div class="mt-8">
        <form action="{{ route('guardar-en-caja') }}" method="POST" id="guardarenCaja" class="block">
            @csrf
            <input type="hidden" name="denomDetalle" id="denomDetalle-oculto">
            <button type="submit"
                class="w-full p-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:shadow transition transform hover:scale-105">
                Guardar en Caja
            </button>
        </form>
    </div>
</div>
