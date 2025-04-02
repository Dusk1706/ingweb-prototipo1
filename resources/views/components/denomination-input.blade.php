@props(['denomination', 'value' => 0, 'large' => false])

<div class="group relative bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-200 dark:border-gray-600 {{ $large ? 'w-full min-w-[150px]' : '' }}">
    <div class="flex flex-col gap-2">
        <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
            ${{ number_format($denomination) }}
        </span>
        <input type="number"
               name="denomDetalle[{{ $denomination }}]"
               data-denominacion="{{ $denomination }}"
               class="denominacion-input w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md text-right text-base text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
               placeholder="0" 
               min="0" 
               value="{{ $value }}">
    </div>
</div>