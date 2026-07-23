@props(['kicker' => null, 'title' => null, 'number' => null])

<div {{ $attributes->merge(['class' => '']) }}>
  @if($kicker || $number)
    <div class="flex items-center gap-3 mb-3">
      @if($number)<span class="font-mono text-[11px] text-bm-yellow tracking-widest">{{ $number }}</span>@endif
      @if($kicker)<span class="label-industrial">{{ $kicker }}</span>@endif
      <span class="h-px w-8 bg-bm-yellow/40"></span>
    </div>
  @endif
  @if($title)
    <h2 class="font-display font-black text-[32px] sm:text-[44px] lg:text-[56px] leading-[0.85] uppercase tracking-tight">
      {!! $title !!}
    </h2>
  @endif
  @if($slot->isNotEmpty())
    <div class="mt-4 text-[15px] leading-relaxed text-bm-gray-light max-w-[52ch]">{{ $slot }}</div>
  @endif
</div>
