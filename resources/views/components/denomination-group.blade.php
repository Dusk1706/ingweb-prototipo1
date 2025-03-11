@props(['type', 'title', 'icon', 'denominations', 'values', 'color'])

<div class="{{ $type === 'coins' ? 'md:col-span-2' : 'md:col-span-3' }}">
    <h4 class="text-lg font-semibold text-{{ $color }}-600 dark:text-{{ $color }}-300 mb-4 flex items-center">
        <x-svg-icon :src="$icon" class="w-6 h-6 mr-2" />
        {{ $title }}
    </h4>

    @if($type === 'coins')
        <div class="space-y-3">
            @foreach($denominations as $denomination)
                <x-denomination-input 
                    :denomination="$denomination"
                    :value="$values[$denomination] ?? 0"
                />
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($denominations as $denomination)
                <x-denomination-input 
                    :denomination="$denomination"
                    :value="$values[$denomination] ?? 0"
                    large
                />
            @endforeach
        </div>
    @endif
</div>