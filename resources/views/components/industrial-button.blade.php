@props(['variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
  $base = 'inline-flex items-center justify-between gap-4 font-display font-bold uppercase tracking-wide text-[13px] transition-colors duration-200 clip-notch';
  $variants = [
    'primary' => 'bg-bm-red text-white px-6 py-3.5 hover:bg-bm-red-dark',
    'secondary' => 'border border-bm-dark/20 text-bm-dark px-6 py-3.5 hover:bg-bm-dark hover:text-bm-cream',
    'yellow' => 'bg-bm-yellow text-bm-dark px-6 py-3.5 hover:bg-bm-yellow-dark',
    'ghost' => 'text-white/70 hover:text-bm-dark px-4 py-2',
  ];
  $cls = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($attributes->get('class') ?? '');
@endphp

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }} <span aria-hidden="true">→</span></a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }} <span aria-hidden="true">→</span></button>
@endif
