<x-app-layout>
    <x-slot name="header">
        <x-header title="Gestión de Caja - Sucursal {{ auth()->user()->id_sucursal }}" />
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-alerts />
            <x-importe-input :importe="$importe ?? 0" />
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-action-button
                    route="{{ route('abrir-caja') }}"
                    icon="icono-abrir-caja.svg"
                    title="Abrir Caja"
                    description="Iniciar operaciones del día"
                    color="blue"
                />

                <x-action-button
                    route="{{ route('cambiar-cheques') }}"
                    icon="icono-cambiar-cheques.svg"
                    title="Cambiar Cheques"
                    description="Gestión de intercambio"
                    color="green"
                >
                    <input type="hidden" name="importe" id="importe-hidden">
                </x-action-button>

                <x-action-button
                    route="{{ route('agregar-dinero') }}"
                    icon="icono-agregar-dinero.svg"
                    title="Agregar Dinero"
                    description="Fondos adicionales"
                    color="purple"
                >
                    <input type="hidden" name="importe" id="importe-hidden-agregar">
                </x-action-button>
            </div>

            <x-denominations-section 
                :coins="[1, 2, 5, 10]"
                :bills="[20, 50, 100, 200, 500, 1000]"
                :denomDetalle="$denomDetalle ?? []"
            />
        </div>
    </div>
</x-app-layout>