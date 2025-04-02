<div class="mb-10 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                <x-svg-icon src="icono-importe.svg" class="w-5 h-5" />
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
                placeholder="0.00" required autocomplete="off" value="{{ $importe }}">
        </div>
    </div>
</div>