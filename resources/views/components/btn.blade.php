@props(['href' => null, 'variant' => 'primary', 'type' => 'button'])

@php
  $base = "inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium transition";
  $primary = "bg-brand-500 text-white hover:bg-brand-600";
  $outline = "border border-gray-300 bg-white text-ink hover:bg-gray-50";
  $classes = $base . " " . ($variant === 'outline' ? $outline : $primary);
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
  </a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
  </button>
@endif
