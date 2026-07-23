@extends('layouts.app')

@section('content')
{{-- HERO — Industrial parallax --}}
<section class="relative overflow-hidden bg-bm-black">
  {{-- Grid texture --}}
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 80px 80px;"></div>

  {{-- Parallax layers --}}
  <div class="parallax-container relative">
    {{-- Back: large typography --}}
    <div data-parallax="0.2" class="pointer-events-none absolute top-10 left-0 right-0 font-display font-black text-[18vw] leading-[0.8] text-white/[0.02] uppercase tracking-tighter select-none hidden lg:block">
      JALUR<br>DARAT & LAUT<br>INDONESIA
    </div>
    {{-- Mid: road line SVG --}}
    <div data-parallax="0.12" class="absolute top-1/2 left-0 w-full h-px hidden md:block">
      <svg width="100%" height="2" class="opacity-20"><line x1="0" y1="1" x2="100%" y2="1" stroke="white" stroke-width="1" stroke-dasharray="40 20"/></svg>
    </div>

    <div class="relative mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 pt-10 pb-16 lg:pt-20 lg:pb-28">
      <div class="grid lg:grid-cols-[1.15fr_0.85fr] gap-8 lg:gap-12 items-start">

        {{-- Left: headline — editable via admin/pages/beranda/edit --}}
        @php
          $sec = $page?->sections ?? [];
          // Helper with fallback
          $v = fn($k,$d) => !empty($sec[$k]) ? $sec[$k] : $d;
        @endphp
        <div class="relative">
          <div class="inline-flex items-center gap-3 mb-6">
            <span class="w-12 h-px bg-bm-yellow"></span>
            <span class="label-industrial">{{ $v('hero_kicker','Sejak 2010 — Palembang • Jakarta • Surabaya') }}</span>
          </div>

          <h1 class="font-display font-black text-[42px] sm:text-[60px] lg:text-[84px] leading-[0.85] tracking-[-0.04em] uppercase">
            <span class="block reveal">{{ $v('hero_title_1','Logistik') }}</span>
            <span class="block reveal text-bm-yellow">{{ $v('hero_title_2','tidak boleh') }}</span>
            <span class="block reveal">{{ $v('hero_title_3','bermain-') }}</span>
            <span class="block reveal-clip bg-bm-red inline-block px-3 py-1 -rotate-1">{{ $v('hero_title_4','main.') }}</span>
          </h1>

          <div class="mt-8 grid sm:grid-cols-[auto_1fr] gap-6 items-start max-w-[54ch]">
            <div class="hidden sm:block w-px h-full min-h-[80px] bg-gradient-to-b from-bm-yellow to-transparent"></div>
            <div>
              <p class="text-[16px] sm:text-[18px] leading-relaxed text-bm-white/80">
                {{ $v('hero_subtitle','Kami mengangkut muatan industri berat, kontainer 40ft, dan distribusi FMCG dengan 120+ armada GPS, asuransi all-risk, dan SOP muat-bongkar yang disiplin.') }}
              </p>
              <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('contact') }}" class="bg-bm-red text-white px-6 py-3.5 font-display font-bold uppercase text-[13px] tracking-wide hover:bg-bm-red-dark clip-notch inline-flex items-center gap-3">
                  {{ $v('hero_cta_primary','Dapat Penawaran 2 Jam') }} <span>→</span>
                </a>
                <a href="#armada" class="border border-white/20 px-6 py-3.5 font-display font-bold uppercase text-[13px] hover:bg-white hover:text-bm-black inline-flex items-center gap-2">{{ $v('hero_cta_secondary','Lihat Armada') }}</a>
              </div>

              {{-- Trust badges --}}
              <div class="mt-8 flex flex-wrap items-center gap-4 font-mono text-[10px] uppercase tracking-widest text-bm-gray-light">
                <span class="inline-flex items-center gap-2"><span class="w-2 h-2 bg-green-500 rounded-full"></span> {{ $v('hero_badge_1','12.847 pengiriman selesai') }}</span>
                <span>•</span>
                <span>{{ $v('hero_badge_2','ISO 9001:2015') }}</span>
                <span>•</span>
                <span>{{ $v('hero_badge_3','Asuransi ACA') }}</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Right: manifest card — asymmetric overlapping --}}
        <div class="relative lg:mt-16">
          {{-- yellow offset block --}}
          <div class="absolute -top-4 -right-4 w-full h-full bg-bm-yellow/20 hidden lg:block"></div>

          <div class="relative bg-bm-black-soft border border-white/10 clip-diagonal">
            <div class="hazard-stripe-sm"></div>
            <div class="p-6 sm:p-8">
              <div class="flex items-start justify-between">
                <div>
                  <div class="label-industrial">Manifest aktif</div>
                  <div class="mt-1 font-mono text-[11px] text-bm-gray-light">ID: {{ $v('hero_manifest_id','BMT-2026-1847') }} • GPS LIVE</div>
                </div>
                <div class="w-8 h-8 border border-bm-yellow/40 flex items-center justify-center">
                  <div class="w-2 h-2 bg-bm-yellow animate-pulse"></div>
                </div>
              </div>

              {{-- Route visual --}}
              <div class="mt-8 relative">
                <div class="flex justify-between font-mono text-[10px] uppercase tracking-widest text-bm-gray-light mb-2">
                  <span>PLG — Asal</span><span>SBY — Tujuan</span>
                </div>
                <div class="h-1 bg-white/10 relative overflow-hidden">
                  <div class="absolute inset-y-0 left-0 w-[68%] bg-bm-red"></div>
                  <div class="absolute top-1/2 -translate-y-1/2 left-[68%] w-3 h-3 bg-bm-yellow rotate-45 border border-bm-black"></div>
                </div>
                <div class="mt-2 flex justify-between text-[11px]">
                  <span class="text-bm-gray-light">Truck Fuso - BE 8123 XY</span>
                  <span class="font-mono text-bm-yellow">ETA 14 jam</span>
                </div>
              </div>

              {{-- cargo grid --}}
              <div class="mt-8 grid grid-cols-3 gap-3 font-mono text-[10px]">
                <div class="bg-bm-black p-3 border border-white/5">
                  <div class="text-bm-gray-light uppercase">Muatan</div>
                  <div class="mt-1 text-[14px] font-bold text-white">18 Ton</div>
                </div>
                <div class="bg-bm-black p-3 border border-white/5">
                  <div class="text-bm-gray-light uppercase">Tipe</div>
                  <div class="mt-1 text-[14px] font-bold text-white">Container</div>
                </div>
                <div class="bg-bm-black p-3 border border-bm-yellow/30">
                  <div class="text-bm-yellow uppercase">Status</div>
                  <div class="mt-1 text-[14px] font-bold text-white">On Road</div>
                </div>
              </div>

              {{-- stats row --}}
              <div class="mt-6 grid grid-cols-3 divide-x divide-white/5 border-y border-white/5 py-3">
                <div class="px-3">
                  <div class="font-mono text-[10px] uppercase text-bm-gray-light">On-time</div>
                  <div class="font-display font-black text-[20px]"><span class="stat-number" data-count="98">0</span><span class="text-bm-yellow">%</span></div>
                </div>
                <div class="px-3">
                  <div class="font-mono text-[10px] uppercase text-bm-gray-light">Armada</div>
                  <div class="font-display font-black text-[20px]"><span class="stat-number" data-count="127">0</span></div>
                </div>
                <div class="px-3">
                  <div class="font-mono text-[10px] uppercase text-bm-gray-light">Kota</div>
                  <div class="font-display font-black text-[20px]"><span class="stat-number" data-count="84">0</span></div>
                </div>
              </div>
            </div>
          </div>

          {{-- Floating quote --}}
          <div class="mt-4 bg-bm-yellow text-bm-black px-4 py-3 font-mono text-[11px] uppercase tracking-wide flex items-center gap-3">
            <span class="font-bold">!</span> {{ $v('hero_manifest_note','SOP bongkar wajib foto 4 sisi + video segel. Tidak ada kompromi.') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Bottom hazard + ticker --}}
  <div class="border-y border-white/5 bg-bm-black-light overflow-hidden">
    <div class="flex animate-marquee whitespace-nowrap py-2 font-mono text-[11px] uppercase tracking-[0.2em] text-bm-gray-light">
      <span class="mx-6">● TRUCKING SUMATERA—JAWA—BALI ● SEA FREIGHT MERAK—BAKAUHENI ● WAREHOUSING 5.000M² PALEMBANG ● GPS REAL-TIME ● ASURANSI ALL-RISK ● DISPATCH 24/7</span>
      <span class="mx-6">● TRUCKING SUMATERA—JAWA—BALI ● SEA FREIGHT MERAK—BAKAUHENI ● WAREHOUSING 5.000M² PALEMBANG ● GPS REAL-TIME ● ASURANSI ALL-RISK ● DISPATCH 24/7</span>
    </div>
  </div>
</section>

{{-- LAYANAN teaser — asymmetric grid --}}
<section class="py-16 lg:py-24 bg-bm-white text-bm-black">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-6">
      <div>
        <div class="flex items-center gap-3">
          <span class="font-mono text-[11px] uppercase tracking-widest text-bm-red font-bold">01 / Layanan Inti</span>
          <span class="w-12 h-px bg-bm-red"></span>
        </div>
        <h2 class="mt-3 font-display font-black text-[36px] sm:text-[52px] leading-[0.85] uppercase">
          Tiga jalur,<br> satu <span class="text-bm-red">standar keras.</span>
        </h2>
      </div>
      <a href="{{ route('layanan.index') }}" class="border border-bm-black/20 px-5 py-3 font-display font-bold uppercase text-[13px] hover:bg-bm-black hover:text-white">Explorasi layanan →</a>
    </div>

    <div class="mt-12 grid lg:grid-cols-3 gap-0 border border-bm-black/10">
      @forelse($services as $idx => $svc)
        <a href="{{ route('layanan.show', $svc->slug) }}" class="group relative bg-white border-b lg:border-b-0 lg:border-r last:border-r-0 border-bm-black/10 p-8 sm:p-10 hover:bg-bm-black hover:text-white transition-colors duration-300">
          <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">0{{ $idx+1 }} — {{ $svc->slug }}</div>
          <h3 class="mt-4 font-display font-black text-[30px] leading-[0.9] uppercase">{{ $svc->title }}</h3>
          <p class="mt-3 text-[14px] leading-relaxed opacity-70 max-w-[30ch]">{{ $svc->excerpt }}</p>
          <div class="mt-8 flex items-center gap-4">
            <div class="w-12 h-12 border border-current flex items-center justify-center group-hover:bg-bm-red group-hover:border-bm-red group-hover:text-white">→</div>
            <div class="font-mono text-[11px] uppercase">Lihat spek & tarif</div>
          </div>
          @if($idx === 1)
            <div class="absolute top-0 right-0 bg-bm-yellow text-bm-black font-mono text-[10px] font-bold px-2 py-1 uppercase">Most requested</div>
          @endif
        </a>
      @empty
        {{-- default static cards when DB empty --}}
        @foreach([['Pengiriman Darat','Jalur Sumatera–Jawa–Bali, truk CDD hingga tronton, overload management.'],['Sea Freight & Kargo','Kontainer 20/40ft, LCL Tanjung Priok–Panjang–Belawan.'],['Pergudangan & Distribusi','Gudang 5.000m² Palembang, WMS, cross-dock, last-mile.']] as $i => $d)
          <div class="bg-white border-b lg:border-b-0 lg:border-r last:border-r-0 border-bm-black/10 p-10">
            <div class="font-mono text-[11px] text-bm-yellow">0{{ $i+1 }}</div>
            <h3 class="mt-4 font-display font-black text-[30px] uppercase leading-[0.9]">{{ $d[0] }}</h3>
            <p class="mt-3 text-[14px] opacity-70">{{ $d[1] }}</p>
          </div>
        @endforeach
      @endforelse
    </div>
  </div>
</section>

{{-- ARMADA teaser — pricing --}}
@php
  $waAll = \App\Models\SiteSetting::getValue('contact.whatsapp','6281234567890');
  $waAllMsg = rawurlencode('Halo BM Trans, saya ingin nego harga armada. Bisa dibantu?');
@endphp
<section id="armada" class="py-16 lg:py-24 bg-bm-black border-y border-white/5 scroll-mt-24">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-6">
      <div>
        <div class="flex items-center gap-3">
          <span class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow font-bold">03 / Armada</span>
          <span class="w-12 h-px bg-bm-yellow"></span>
          <span class="font-mono text-[11px] uppercase tracking-widest text-bm-gray-light">Harga mulai • Nego dengan Admin Sampai Jadi!</span>
        </div>
        <h2 class="mt-3 font-display font-black text-[36px] sm:text-[52px] leading-[0.85] uppercase">
          Armada siap jalan,<br> harga <span class="text-bm-yellow">transparan.</span>
        </h2>
        <p class="mt-3 max-w-[56ch] text-[14px] text-bm-white/60">Harga di bawah mulai dalam kota / rute pendek. Antar kota menyesuaikan tonase & rute. Semua harga negotiable — chat admin.</p>
      </div>
      <a href="{{ route('armada.index') }}" class="border border-white/15 px-5 py-3 font-display font-bold uppercase text-[13px] hover:bg-white hover:text-bm-black">Lihat semua tarif →</a>
    </div>

    @if($armadas->isNotEmpty())
      <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 lg:gap-5">
        @foreach($armadas->take(10) as $a)
          @php
            $waText = rawurlencode("Halo BM Trans, nego harga {$a->name} (Mulai Rp {$a->display_price}) — rute saya: [isi rute]");
            $imgUrl = $a->image_url;
          @endphp
          <div class="group bg-bm-black-soft border border-white/10 overflow-hidden flex flex-col hover:border-bm-yellow/40 transition-colors">
            <div class="aspect-[16/10] bg-bm-black relative overflow-hidden">
              @if($imgUrl)
                <img src="{{ $imgUrl }}" alt="{{ $a->name }}" class="w-full h-full object-cover group-hover:scale-[1.05] transition duration-500" loading="lazy">
              @else
                <div class="w-full h-full flex items-center justify-center font-display font-black text-[42px] text-white/10">{{ \Illuminate\Support\Str::substr($a->name,0,2) }}</div>
                <div class="absolute inset-0 opacity-[0.05]" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 32px 32px;"></div>
              @endif
              <div class="absolute top-0 left-0 right-0 h-[3px] bg-bm-yellow"></div>
              <div class="absolute bottom-2 left-2 flex gap-1.5">
                <span class="font-mono text-[9px] uppercase tracking-widest px-1.5 py-0.5 bg-bm-black/80 backdrop-blur text-white border border-white/10">{{ $a->type ?: 'ARMADA' }}</span>
              </div>
            </div>
            <div class="p-4 flex flex-col flex-1 gap-2">
              <div class="flex items-start justify-between gap-2">
                <div class="font-display font-black text-[16px] leading-[0.9] uppercase text-white">{{ $a->name }}</div>
                <span class="font-mono text-[10px] text-bm-gray-light shrink-0">{{ sprintf('%02d', $loop->iteration) }}</span>
              </div>
              <div class="mt-1">
                <div class="font-mono text-[9px] uppercase tracking-widest text-bm-white/50">Mulai dari</div>
                <div class="flex items-baseline gap-1 text-white"><span class="font-mono text-[10px] text-bm-gray-light">Rp</span><span class="font-display font-black text-[20px]">{{ $a->display_price }}</span></div>
              </div>
              <a href="https://wa.me/{{ $waAll }}?text={{ $waText }}" target="_blank" class="mt-auto inline-flex w-full justify-center bg-bm-yellow text-bm-black px-3 py-2.5 font-display font-bold uppercase text-[10px] leading-tight text-center hover:bg-white transition">Nego dengan Admin<br>Sampai Jadi! →</a>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-6 flex flex-wrap items-center gap-3 font-mono text-[11px]">
        <span class="px-3 py-1.5 bg-bm-yellow/10 border border-bm-yellow/20 text-bm-yellow">✓ Nego dengan Admin Sampai Jadi!</span>
        <span class="px-3 py-1.5 border border-white/10 text-bm-gray-light">Estimasi 2 jam kerja untuk quote final</span>
      </div>
    @else
      {{-- fallback static when DB empty --}}
      <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 lg:gap-5">
        @foreach([['Pickup Bak','pickup','200rb'],['Pickup Box','pickup','200rb'],['Colt Diesel Engkel Bak','colt_diesel','400rb'],['Colt Diesel Engkel Box','colt_diesel','450rb'],['Colt Diesel Double Bak','colt_diesel','600rb'],['Colt Diesel Double Box','colt_diesel','600rb'],['Fusso Engkel Bak','fusso','1,2jt'],['Fusso Engkel Box','fusso','1,2jt'],['Tronton Bak','tronton','1,6jt'],['Tronton Wingbox','tronton','1,6jt']] as $i => $row)
          @php $waText = rawurlencode("Halo BM Trans, nego harga {$row[0]} (Mulai Rp {$row[2]}) — rute saya: [isi rute]"); @endphp
          <div class="bg-bm-black-soft border border-white/10 p-0 overflow-hidden flex flex-col">
            <div class="aspect-[16/10] bg-bm-black flex items-center justify-center font-display text-white/10 text-[32px]">{{ \Illuminate\Support\Str::substr($row[0],0,2) }}</div>
            <div class="p-4">
              <div class="font-mono text-[10px] uppercase">{{ $row[1] }} • 0{{ $i+1 }}</div>
              <div class="mt-2 font-display font-black uppercase text-[15px] leading-[0.9]">{{ $row[0] }}</div>
              <div class="mt-3 font-mono text-[9px] opacity-60 uppercase">Mulai dari</div>
              <div class="font-display font-black text-[20px]">Rp {{ $row[2] }}</div>
              <a href="https://wa.me/{{ $waAll }}?text={{ $waText }}" target="_blank" class="mt-3 inline-flex w-full justify-center bg-bm-yellow text-bm-black px-3 py-2 font-display font-bold uppercase text-[10px] leading-tight text-center">Nego dengan Admin<br>Sampai Jadi! →</a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

{{-- STATS + TESTIMONI --}}
<section class="py-16 lg:py-20 bg-bm-black border-y border-white/5">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-[0.9fr_1.1fr] gap-12 lg:gap-16">

      <div class="reveal">
        <div class="label-industrial">Track record</div>
        <h2 class="mt-3 font-display font-black text-[40px] sm:text-[56px] leading-[0.85] uppercase">Angka yang<br> <span class="text-bm-yellow">di-test di lapangan,</span><br> bukan slide.</h2>
        <div class="mt-8 grid grid-cols-2 gap-6">
          <div class="border border-white/10 p-5">
            <div class="font-display text-[36px] leading-none"><span class="stat-number" data-count="12000">0</span>+</div>
            <div class="font-mono text-[11px] uppercase tracking-widest text-bm-gray-light mt-2">Pengiriman selesai</div>
          </div>
          <div class="border border-white/10 p-5">
            <div class="font-display text-[36px] leading-none"><span class="stat-number" data-count="98">0</span>%</div>
            <div class="font-mono text-[11px] uppercase tracking-widest text-bm-gray-light mt-2">On-time delivery</div>
          </div>
          <div class="border border-white/10 p-5">
            <div class="font-display text-[36px] leading-none"><span class="stat-number" data-count="127">0</span></div>
            <div class="font-mono text-[11px] uppercase tracking-widest text-bm-gray-light mt-2">Unit aktif + GPS</div>
          </div>
          <div class="bg-bm-yellow text-bm-black p-5">
            <div class="font-display text-[36px] leading-none">24/7</div>
            <div class="font-mono text-[11px] uppercase tracking-widest mt-2 font-bold">Dispatch & monitoring</div>
          </div>
        </div>
      </div>

      <div class="reveal">
        <div class="flex items-center justify-between">
          <div class="label-industrial">Testimoni — kata mereka yang muatan harus sampai</div>
          <div class="h-px w-16 bg-bm-yellow/30"></div>
        </div>
        <div class="mt-6 space-y-4">
          @forelse($testimonials as $t)
            <div class="bg-bm-black-soft border border-white/5 p-5 flex gap-4">
              <div class="w-10 h-10 bg-bm-white/10 flex items-center justify-center font-display font-bold">{{ Str::substr($t->name,0,1) }}</div>
              <div>
                <div class="font-display font-bold uppercase text-[15px]">{{ $t->name }} <span class="font-body normal-case font-normal text-bm-gray-light text-[12px]">• {{ $t->company }}</span></div>
                <div class="mt-1 text-[13px] text-bm-white/80 leading-relaxed">"{{ $t->quote }}"</div>
              </div>
            </div>
          @empty
            <div class="bg-bm-black-soft border border-white/5 p-6">
              <div class="font-display font-bold uppercase">PT Sumber Makmur Abadi — Palembang</div>
              <div class="mt-2 text-[14px] text-bm-white/70">"Sudah 3 tahun pakai BM Trans untuk distribusi pupuk Sumatera. On-time, driver disiplin SOP, kalau ada insiden lapor real, bukan ngilang."</div>
            </div>
            <div class="bg-bm-black-soft border border-white/5 p-6">
              <div class="font-display font-bold uppercase">CV Logistik Baja — Cilegon</div>
              <div class="mt-2 text-[14px] text-bm-white/70">"Muatan wire rod 20 ton butuh handling khusus. BM Trans satu-satunya yang mau pakai alas kayu + rantai, bukan cuma tali."</div>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ARTIKEL --}}
<section class="py-16 lg:py-20 bg-bm-black">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between">
      <x-section-label kicker="Insight lapangan" number="02" title="Artikel &<br> panduan <span class='text-bm-gray-light'>yang tajam,</span>" />
      <a href="{{ route('articles.index') }}" class="hidden sm:inline-flex border border-white/15 px-5 py-3 font-display uppercase text-[13px]">Lihat semua →</a>
    </div>

    <div class="mt-10 grid md:grid-cols-3 gap-6">
      @forelse($articles as $art)
        <a href="{{ route('articles.show', $art->slug) }}" class="group block bg-bm-black-soft border border-white/5 hover:border-bm-yellow/30 transition-colors">
          <div class="aspect-[16/10] bg-bm-black-light relative overflow-hidden">
            @if($art->featured_image)
              <img src="{{ asset('storage/'.$art->featured_image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition duration-500" loading="lazy">
            @else
              <div class="w-full h-full flex items-center justify-center font-display text-[40px] text-white/5">BM</div>
            @endif
            <div class="absolute left-0 top-0 bg-bm-yellow text-bm-black font-mono text-[10px] px-2 py-1 uppercase">{{ $art->category?->name ?? 'LOGISTIK' }}</div>
          </div>
          <div class="p-5">
            <div class="font-mono text-[11px] text-bm-gray-light">{{ $art->published_at?->format('d M Y') }}</div>
            <h3 class="mt-2 font-display font-bold uppercase text-[18px] leading-[0.95] group-hover:text-bm-yellow">{{ $art->title }}</h3>
            <p class="mt-2 text-[13px] text-bm-gray-light line-clamp-2">{{ $art->excerpt }}</p>
          </div>
        </a>
      @empty
        <div class="md:col-span-3 text-bm-gray-light">Belum ada artikel — segera hadir.</div>
      @endforelse
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="relative bg-bm-red overflow-hidden">
  <div class="hazard-stripe"></div>
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 py-14 lg:py-20 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
    <div>
      <div class="font-mono text-[11px] uppercase tracking-widest text-white/70">Siap berangkat hari ini?</div>
      <h2 class="mt-2 font-display font-black text-[40px] sm:text-[52px] leading-[0.85] uppercase text-white">Kirimkan rute Anda.<br> Kami hitung <span class="bg-bm-black px-2">2 jam.</span></h2>
    </div>
    <div class="flex flex-col sm:flex-row gap-3">
      <a href="{{ route('contact') }}" class="bg-bm-black text-white px-8 py-4 font-display font-bold uppercase text-[14px] tracking-wide clip-notch inline-flex items-center gap-3">Minta Penawaran Cepat <span>→</span></a>
      <a href="https://wa.me/{{ \App\Models\SiteSetting::getValue('contact.whatsapp','6281234567890') }}" target="_blank" class="bg-white text-bm-black px-8 py-4 font-display font-bold uppercase text-[14px]">Chat WhatsApp</a>
    </div>
  </div>
</section>

@push('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => 'PT Berkah Makmur Transport',
  'url' => request()->root(),
  'logo' => asset('images/logo.png'),
  'description' => 'Logistic Express Sumatera-Jawa-Bali — trucking, sea freight, pergudangan.',
  'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Palembang', 'addressCountry' => 'ID']
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush
@endsection
