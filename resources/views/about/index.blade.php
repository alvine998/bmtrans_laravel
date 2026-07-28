@php
  $logo = \App\Models\SiteSetting::getValue('branding.logo');
  $s = $page?->sections ?? [];
  $kicker = $s['hero_kicker'] ?? 'Tentang Kami';
  $title1 = $s['hero_title_1'] ?? 'Mitra logistik';
  $title2 = $s['hero_title_2'] ?? 'yang tepat.';
  $intro1 = $s['intro_1'] ?? 'PT Berkah Makmur Transport berdiri 2010 di Palembang. Berawal dari 3 truk, kini kami melayani pengiriman darat Sumatera–Jawa–Bali, sea freight, dan pergudangan dengan armada yang terus berkembang.';
  $intro2 = $s['intro_2'] ?? 'Kami percaya logistik yang baik adalah yang transparan, tepat waktu, dan dapat diandalkan. Tidak ada biaya tersembunyi, tidak ada janji kosong.';
  $visi = $s['visi'] ?? 'Menjadi penyedia jasa logistik paling terpercaya di Indonesia.';
  $misi = $s['misi'] ?? 'Memberikan layanan tepat waktu, transparan, dan profesional untuk setiap pengiriman.';
  $legalSiup = $s['legal_siup'] ?? 'SIUP: 503/XXX/2012';
  $legalNpwp = $s['legal_npwp'] ?? 'NPWP: 00.000.000.0-000.000';
  $legalTdp = $s['legal_tdp'] ?? 'TDP: 06033520xxxx';
  $legalIso = $s['legal_iso'] ?? 'Legal & Terpercaya';
  $fleetCdd = $s['fleet_cdd'] ?? '42 unit';
  $fleetFuso = $s['fleet_fuso'] ?? '38 unit';
  $fleetTronton = $s['fleet_tronton'] ?? '28 unit';
  $fleetTrailer = $s['fleet_trailer'] ?? '19 unit';
@endphp
@extends('layouts.app')
@section('content')
<section class="bg-bm-black pt-10 pb-16">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    @if($logo)
      <div class="w-16 h-16 bg-bm-black-soft border border-white/10 flex items-center justify-center overflow-hidden mb-4">
        <img src="{{ asset('storage/'.$logo) }}" alt="Logo Berkah Makmur Transport" class="w-full h-full object-contain">
      </div>
    @endif
    <div class="label-industrial">{{ $kicker }}</div>
    <h1 class="mt-3 font-display font-black text-[44px] sm:text-[64px] leading-[0.85] uppercase">{{ $title1 }}<br><span class="text-bm-yellow">{{ $title2 }}</span></h1>

    <div class="mt-12 grid lg:grid-cols-[1.1fr_0.9fr] gap-12">
      <div class="max-w-none">
        <p class="text-[18px] leading-relaxed text-bm-white/80">{{ $intro1 }}</p>
        <p class="mt-4 text-bm-white/70">{{ $intro2 }}</p>
        <h3 class="font-display uppercase mt-8 text-bm-yellow">Visi & Misi</h3>
        <ul class="mt-2 space-y-2 text-bm-white/70">
          <li><span class="text-bm-yellow">Visi:</span> {{ $visi }}</li>
          <li><span class="text-bm-yellow">Misi:</span> {{ $misi }}</li>
        </ul>
        <h3 class="font-display uppercase mt-8 text-bm-yellow">Legalitas</h3>
        <div class="mt-2 grid grid-cols-2 gap-3 font-mono text-[11px]">
          <span class="border border-white/10 p-3">{{ $legalSiup }}</span>
          <span class="border border-white/10 p-3">{{ $legalNpwp }}</span>
          <span class="border border-white/10 p-3">{{ $legalTdp }}</span>
          <span class="border border-white/10 p-3 bg-bm-yellow text-bm-black font-bold">{{ $legalIso }}</span>
        </div>
      </div>

      <div class="space-y-6">
        <div class="bg-bm-black-soft border border-white/10 p-6">
          <div class="label-industrial">Armada</div>
          <div class="mt-4 grid grid-cols-2 gap-4 font-mono text-[12px]">
            <div><div class="text-bm-gray-light">CDD</div><div class="font-display text-[20px]">{{ $fleetCdd }}</div></div>
            <div><div class="text-bm-gray-light">Fuso</div><div class="font-display text-[20px]">{{ $fleetFuso }}</div></div>
            <div><div class="text-bm-gray-light">Tronton</div><div class="font-display text-[20px]">{{ $fleetTronton }}</div></div>
            <div><div class="text-bm-gray-light">Trailer</div><div class="font-display text-[20px]">{{ $fleetTrailer }}</div></div>
          </div>
        </div>

        @if($team->count())
          <div class="bg-bm-black-soft border border-white/10 p-6">
            <div class="label-industrial">Tim Kami</div>
            <div class="mt-4 space-y-3">
              @foreach($team as $m)
                <div class="flex gap-3 p-3 border border-white/5">
                  <div class="w-10 h-10 bg-bm-yellow/20 text-bm-yellow flex items-center justify-center font-display font-bold shrink-0">{{ Str::substr($m->name,0,1) }}</div>
                  <div><div class="font-display uppercase text-[14px]">{{ $m->name }}</div><div class="font-mono text-[11px] text-bm-gray-light">{{ $m->position }}</div></div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
