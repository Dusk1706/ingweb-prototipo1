@if ($errors->any())
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-400">
        <div class="flex items-center">
            <img src="{{ asset('images/error-icon.svg') }}" class="w-5 h-5 flex-shrink-0" alt="Error">
            <div class="ml-3 text-sm text-red-700 dark:text-red-400">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-400">
        <div class="flex items-center">
            <img src="{{ asset('images/error-icon.svg') }}" class="w-5 h-5 flex-shrink-0" alt="Error">
            <div class="ml-3 text-sm text-red-700 dark:text-red-400">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/20 border-l-4 border-green-500 dark:border-green-400">
        <div class="flex items-center">
            <img src="{{ asset('images/success-icon.svg') }}" class="w-5 h-5 flex-shrink-0" alt="Éxito">
            <div class="ml-3 text-sm text-green-700 dark:text-green-400">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif