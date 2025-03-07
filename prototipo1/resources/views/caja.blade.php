<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Gestión de Caja
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Botón: Abrir Caja -->
                <form action="{{ route('abrir-caja') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <div class="flex flex-col items-center">
                            <div class="mb-4 p-4 bg-blue-500 rounded-full">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Abrir Caja</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">Iniciar operaciones del día</p>
                        </div>
                    </button>
                </form>
                

                <!-- Botón: Cambiar Cheques -->
                <a href="{{ route('cambiar-cheques') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                    <div class="flex flex-col items-center">
                        <div class="mb-4 p-4 bg-green-500 rounded-full">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4M4 17h16m0 0l-4 4m4-4l-4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Cambiar Cheques</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">Gestión de intercambio</p>
                    </div>
                </a>

                <!-- Botón: Agregar Dinero -->
                <a href="{{ route('agregar-dinero') }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                    <div class="flex flex-col items-center">
                        <div class="mb-4 p-4 bg-purple-500 rounded-full">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zm0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Agregar Dinero</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">Fondos adicionales</p>
                    </div>
                </a>
            </div>

            <!-- Sección adicional: Estado de la Caja -->
            <div class="mt-10 bg-gray-100 dark:bg-gray-900 p-6 rounded-xl shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200">Estado Actual</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Última actualización: hace 15 minutos</p>
                    </div>
                    <span class="px-4 py-2 bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-100 rounded-full text-sm font-medium">
                        Activo
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
