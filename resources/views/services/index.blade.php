@extends('layouts.app')
@section('content')
<section class="bg-bm-black pt-12 pb-16">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="label-industrial">Layanan</div>
    <h1 class="mt-3 font-display font-black text-[48px] sm:text-[72px] leading-[0.85] uppercase">Tiga jalur.<br><span class="text-bm-yellow">Satu SOP.</span></h1>
    <p class="mt-6 max-w-[52ch] text-[16px] text-bm-white/70">Semua layanan dikendalikan dispatch pusat Palembang, GPS real-time, dan dokumentasi bongkar foto+video.</p>
    <div class="mt-12 grid md:grid-cols-3 gap-6">
      @foreach($services as $s)
        <a href="{{ route('layanan.show',$s->slug) }}" class="group bg-bm-black-soft border border-white/10 p-8 hover:border-bm-yellow/40">
          <div class="font-mono text-[11px] text-bm-yellow">{{ $s->slug }}</div>
          <h2 class="mt-3 font-display font-black text-[28px] uppercase">{{ $s->title }}</h2>
          <p class="mt-2 text-[14px] text-bm-gray-light">{{ $s->excerpt }}</p>
          <div class="mt-6 inline-flex items-center gap-2 border border-white/15 px-4 py-2 font-display uppercase text-[12px] group-hover:bg-bm-yellow group-hover:text-bm-black group-hover:border-bm-yellow">Detail →</div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endsection
