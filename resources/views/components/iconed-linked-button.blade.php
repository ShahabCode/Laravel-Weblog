@props([
    'href'     => '#',
    'icon'     => null,
    'variant'  => 'primary',
    'disabled' => false,
])

@php
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'success' => 'bg-green-600 hover:bg-green-700 text-white',
        'danger'  => 'bg-red-600 hover:bg-red-700 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'outline' => 'border border-gray-400 hover:bg-gray-100 text-gray-700',
    ];

    $classes = 'inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-semibold transition-colors ' . ($variants[$variant] ?? $variants['primary']);

    if ($disabled) $classes .= ' opacity-50 cursor-not-allowed pointer-events-none';
@endphp

<a href="{{ $disabled ? '#' : $href }}" class="{{ $classes }}" {{ $attributes }}>
    @if($icon)
        <i class="fas {{ $icon }}"></i>
    @endif
    {{ $slot }}
</a>
