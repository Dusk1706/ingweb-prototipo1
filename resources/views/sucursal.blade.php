<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Gestión de Caja - Sucursal {{ auth()->user()->id_sucursal }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-alerts />

            <!-- Input de Importe -->
            <div
                class="mb-10 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="max-w-2xl mx-auto">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            <img src="{{ asset('images/icono-importe.svg') }}" class="w-5 h-5 inline-block mr-2"
                                alt="Icono importe">
                            Importe
                        </h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">MXN</span>
                    </div>

                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-2xl text-gray-400 dark:text-gray-500">$</span>
                        </div>
                        <input type="number" id="importe" name="importe"
                            class="w-full py-4 pl-10 pr-4 text-3xl font-medium text-white bg-gray-50 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800/50 transition-all"
                            placeholder="0.00" required autocomplete="off" value="{{ $importe ?? 0 }}">

                    </div>

                </div>
            </div>

            <!-- Grid de Botones -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Botón: Abrir Caja -->
                <form action="{{ url('/sucursal/abrir-caja') }}" method="POST" class="block">
                    @csrf
                    <button type="submit"
                        class="w-full p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <div class="flex flex-col items-center">
                            <div class="mb-4 p-4 bg-blue-500 rounded-full">
                                <img src="{{ asset('images/icono-abrir-caja.svg') }}" alt="Abrir Caja"
                                    class="w-10 h-10">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Abrir Caja</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">Iniciar operaciones del día</p>
                        </div>
                    </button>
                </form>

                <!-- Botón: Cambiar Cheques -->
                <form action="{{ route('cambiar-cheques') }}" method="POST" id="cambiarChequesForm" class="block">
                    @csrf
                    <!-- Campo oculto que recibirá el valor del importe ingresado -->
                    <input type="hidden" name="importe" id="importe-hidden">
                    <button type="submit"
                        class="w-full p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <div class="flex flex-col items-center">
                            <div class="mb-4 p-4 bg-green-500 rounded-full">
                                <img src="{{ asset('images/icono-cambiar-cheques.svg') }}" alt="Cambiar Cheques"
                                    class="w-10 h-10">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Cambiar Cheques</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">Gestión de intercambio</p>
                        </div>
                    </button>
                </form>

                <!-- Botón: Agregar Dinero -->
                <form action="{{ route('agregar-dinero') }}" method="POST" class="block">
                    @csrf
                    <!-- Si es necesario enviar el importe también, agrega un campo oculto similar -->
                    <input type="hidden" name="importe" id="importe-hidden-agregar">
                    <button type="submit"
                        class="w-full p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <div class="flex flex-col items-center">
                            <div class="mb-4 p-4 bg-purple-500 rounded-full">
                                <img src="{{ asset('images/icono-agregar-dinero.svg') }}" alt="Agregar Dinero"
                                    class="w-10 h-10">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Agregar Dinero</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">Fondos adicionales</p>
                        </div>
                    </button>
                </form>
            </div>
            <script>
                // Al enviar el formulario de Cambiar Cheques, copiamos el valor del input visible al input oculto.
                document.getElementById('cambiarChequesForm').addEventListener('submit', function(e) {
                    var importe = document.getElementById('importe').value;
                    document.getElementById('importe-hidden').value = importe;
                });

                // Si también se requiere enviar el importe para Agregar Dinero, se puede hacer similar:
                document.querySelector('form[action="{{ route('agregar-dinero') }}"]').addEventListener('submit', function(e) {
                    var importe = document.getElementById('importe').value;
                    document.getElementById('importe-hidden-agregar').value = importe;
                });
            </script>

            <!-- Sección de Detalle de Efectivo -->
            <div
                class="mt-10 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                    <!-- Monedas -->
                    <div class="md:col-span-2">
                        <h4 class="text-lg font-semibold text-amber-600 dark:text-amber-300 mb-4 flex items-center">
                            <img src="{{ asset('images/icono-monedas.svg') }}" class="w-6 h-6 mr-2" alt="Monedas">
                            Denominaciones Menores
                        </h4>
                        <div class="space-y-3">
                            @foreach ([1, 2, 5, 10] as $coin)
                                <div
                                    class="flex items-center justify-between bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <span
                                        class="text-base font-medium text-gray-700 dark:text-gray-300">${{ $coin }}</span>
                                    <input type="number" data-denominacion="{{ $coin }}"
                                        name="denomDetalle[{{ $coin }}]"
                                        class="denominacion-input w-20 px-2 py-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md text-right text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0" min="0" value="{{ $denomDetalle[$coin] ?? 0 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Billetes -->
                    <div class="md:col-span-3">
                        <h4 class="text-lg font-semibold text-green-600 dark:text-green-300 mb-4 flex items-center">
                            <img src="{{ asset('images/icono-billete.svg') }}" class="w-6 h-6 mr-2" alt="Billetes">
                            Denominaciones Mayores
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ([20, 50, 100, 200, 500, 1000] as $bill)
                            <div class="group relative bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                <div class="flex flex-col gap-2">
                                    <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                        ${{ number_format($bill) }}
                                    </span>
                                    <input type="number" 
                                           name="denomDetalle[{{ $bill }}]"  
                                           data-denominacion="{{ $bill }}"
                                           class="denominacion-input w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md text-right text-base text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="0" min="0" 
                                           value="{{ $denomDetalle[$bill] ?? 0 }}">
                                </div>
                            </div>
                        @endforeach                        
                        </div>
                    </div>
                </div>
                
                <!--crear boton para enviar los billetes a la BD-->
                <div class="mt-8">
                    <form action="{{ route('guardar-en-caja') }}" method="POST" id="guardarenCaja" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full p-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:shadow transition transform hover:scale-105">
                            Guardar en Caja
                        </button>
                    </form>
                </div>
            
                <!-- Total -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-2 md:mb-0">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total calculado automáticamente</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total:</span>
                            <span class="text-3xl font-bold text-blue-600 dark:text-blue-300">
                                $<span id="total-calculado">0.00</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
