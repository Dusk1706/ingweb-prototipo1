<form action="{{ $route }}" method="POST" class="block">
    @csrf
    {{ $slot }}
    <button type="submit"
        class="w-full p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
        <div class="flex flex-col items-center">
            <div class="mb-4 p-4 bg-{{ $color }}-500 rounded-full">
                <x-svg-icon src="{{ $icon }}" class="w-10 h-10" />
            </div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $title }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mt-2 text-center">{{ $description }}</p>
        </div>
    </button>
</form>