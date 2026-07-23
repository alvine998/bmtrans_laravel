@php
  $logo = \App\Models\SiteSetting::getValue('branding.logo');
  $s = $page?->sections ?? [];
  $kicker = $s['hero_kicker'] ?? 'Tentang Kami';
  $title1 = $s['hero_title_1'] ?? 'Bukan sekadar';
  $title2 = $s['hero_title_2'] ?? 'angkut-angkut.';
  $intro1 = $s['intro_1'] ?? 'PT Berkah Makmur Transport berdiri 2010 di Palembang. Awalnya hanya 3 truk CDD untuk angkutan pupuk, kini mencakup jalur darat Sumatera–Jawa–Bali, sea freight LCL via Tanjung Priok–Panjang–Belawan, dan gudang 5.000m².';
  $intro2 = $s['intro_2'] ?? 'Kami menolak overloading di atas toleransi, menolak jalan tikus tanpa izin, menolak bongkar tanpa dokumentasi. Mahal sedikit di depan, tapi murah di klaim belakang.';
  $visi = $s['visi'] ?? 'Menjadi logistik industri paling dapat diandalkan di koridor barat Indonesia.';
  $misi = $s['misi'] ?? 'Disiplin SOP, transparan tracking, driver sejahtera, kargo selamat.';
  $legalSiup = $s['legal_siup'] ?? 'SIUP: 503/XXX/2012';
  $legalNpwp = $s['legal_npwp'] ?? 'NPWP: 00.000.000.0-000.000';
  $legalTdp = $s['legal_tdp'] ?? 'TDP: 06033520xxxx';
  $legalIso = $s['legal_iso'] ?? 'ISO 9001:2015';
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
      <div class="prose prose-invert max-w-none">
        <p class="text-[18px] leading-relaxed text-bm-white/80">{{ $intro1 }}</p>
        <p class="text-bm-white/70">{{ $intro2 }}</p>
        <h3 class="font-display uppercase mt-8">Visi & Misi</h3>
        <ul class="text-bm-white/70">
          <li>Visi: {{ $visi }}</li>
          <li>Misi: {{ $misi }}</li>
        </ul>
        <h3 class="font-display uppercase mt-8">Legalitas</h3>
        <div class="grid grid-cols-2 gap-3 font-mono text-[11px]">
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
            <div><div class="text-bm-gray-light">Trailer 40ft</div><div class="font-display text-[20px]">{{ $fleetTrailer }}</div></div>
          </div>
        </div>

        @if($team->count())
          <div class="space-y-3">
            @foreach($team as $m)
              <div class="bg-bm-black-soft border border-white/5 p-4 flex gap-3">
                <div class="w-10 h-10 bg-white/10 flex items-center justify-center font-display">{{ Str::substr($m->name,0,1) }}</div>
                <div><div class="font-display uppercase">{{ $m->name }}</div><div class="font-mono text-[11px] text-bm-gray-light">{{ $m->position }}</div></div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
