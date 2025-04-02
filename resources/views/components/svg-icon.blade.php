@props(['src', 'class' => 'w-6 h-6'])
<img src="{{ asset('images/' . $src) }}" {{ $attributes->merge(['class' => $class]) }} alt="{{ $src }}">
