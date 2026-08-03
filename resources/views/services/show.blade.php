@extends('layouts.app')
@section('content')
<section class="bg-bm-cream text-bm-dark">
  <div class="hazard-stripe"></div>
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
    <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12">
      <div>
        <div class="font-mono text-[11px] uppercase tracking-widest text-bm-red font-bold">Layanan / {{ $service->slug }}</div>
        <h1 class="mt-4 font-display font-black text-[48px] sm:text-[64px] leading-[0.85] uppercase">{{ $service->title }}</h1>
        <div class="mt-6 prose prose-zinc max-w-none prose-p:text-[16px] prose-p:leading-relaxed">
          {!! $service->body ?: '<p>'.$service->excerpt.'</p>' !!}
        </div>
        <div class="mt-8 flex gap-3">
          <a href="{{ route('contact') }}" class="bg-bm-red text-white px-6 py-3 font-display font-bold uppercase text-[13px]">Minta Penawaran →</a>
          <a href="{{ route('layanan.index') }}" class="border border-bm-dark/15 px-6 py-3 font-display uppercase text-[13px]">Kembali ke layanan</a>
        </div>
      </div>
      <div class="space-y-6">
        @if($service->features)
          <div class="bg-bm-dark text-bm-cream p-6 border border-bm-dark/5">
            <div class="label-industrial">Proses & Armada</div>
            <ul class="mt-4 space-y-2 font-mono text-[13px]">
              @foreach((array)$service->features as $f)
                <li class="flex gap-3"><span class="text-bm-yellow">—</span> {{ is_string($f) ? $f : json_encode($f) }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if($otherServices->count())
          <div class="border border-bm-dark/10 p-6">
            <div class="font-mono text-[11px] uppercase">Layanan lain</div>
            <div class="mt-3 space-y-2">
              @foreach($otherServices as $os)
                <a href="{{ route('layanan.show',$os->slug) }}" class="block font-display uppercase text-[16px] hover:text-bm-red">{{ $os->title }}</a>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
