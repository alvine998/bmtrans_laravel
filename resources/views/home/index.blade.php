@extends('layouts.app')

@section('content')
{{-- HERO — Simple, general logistics --}}
<section class="relative overflow-hidden bg-bm-black">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 80px 80px;"></div>

  <div class="parallax-container relative">
    <div data-parallax="0.2" class="pointer-events-none absolute top-10 left-0 right-0 font-display font-black text-[18vw] leading-[0.8] text-white/[0.02] uppercase tracking-tighter select-none hidden lg:block">
      DARAT & LAUT<br>INDONESIA
    </div>

    <div class="relative mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 pt-10 pb-16 lg:pt-20 lg:pb-28">
      <div class="grid lg:grid-cols-[1.15fr_0.85fr] gap-8 lg:gap-12 items-center">
        @php
          $sec = $page?->sections ?? [];
          $v = fn($k,$d) => !empty($sec[$k]) ? $sec[$k] : $d;
        @endphp

        <div>
          <div class="inline-flex items-center gap-3 mb-6">
            <span class="w-12 h-px bg-bm-yellow"></span>
            <span class="label-industrial">{{ $v('hero_kicker','Sejak 2010 — Palembang • Jakarta • Surabaya') }}</span>
          </div>

          <h1 class="font-display font-black text-[42px] sm:text-[60px] lg:text-[84px] leading-[0.85] tracking-[-0.04em] uppercase">
            <span class="block reveal">{{ $v('hero_title_1','Pengiriman') }}</span>
            <span class="block reveal text-bm-yellow">{{ $v('hero_title_2','Tepat Waktu,') }}</span>
            <span class="block reveal">{{ $v('hero_title_3','Bisnis Makin') }}</span>
            <span class="block reveal text-bm-red">{{ $v('hero_title_4','Tumbuh.') }}</span>
          </h1>

          <p class="mt-6 max-w-[52ch] text-[16px] sm:text-[18px] leading-relaxed text-bm-white/80">
            {{ $v('hero_subtitle','Jangkauan luas di Indonesia dengan armada lengkap: pickup, engkel box, CDD, fuso, wing box. Kami siap antar barang & logistik Anda.') }}
          </p>

          <div class="mt-6 flex flex-wrap gap-3">
            <a href="https://wa.me/{{ \App\Models\SiteSetting::getValue('contact.whatsapp','6281234567890') }}" target="_blank" class="bg-bm-red text-white px-6 py-3.5 font-display font-bold uppercase text-[13px] tracking-wide hover:bg-bm-red-dark clip-notch inline-flex items-center gap-3">
              Mulai Kirim (WhatsApp) <span>→</span>
            </a>
            <a href="#armada" class="border border-white/20 px-6 py-3.5 font-display font-bold uppercase text-[13px] hover:bg-white hover:text-bm-black inline-flex items-center gap-2">{{ $v('hero_cta_secondary','Lihat Armada') }}</a>
          </div>

          <div class="mt-8 flex flex-wrap items-center gap-4 font-mono text-[10px] uppercase tracking-widest text-bm-gray-light">
            <span class="inline-flex items-center gap-2"><span class="w-2 h-2 bg-green-500 rounded-full"></span> {{ $v('hero_badge_1','12.000+ pengiriman') }}</span>
            <span>•</span>
            <span>{{ $v('hero_badge_2','GPS real-time') }}</span>
            <span>•</span>
            <span>{{ $v('hero_badge_3','Asuransi penuh') }}</span>
          </div>
        </div>

        {{-- Right: quick info card --}}
        <div class="relative lg:mt-8">
          <div class="relative bg-bm-black-soft border border-white/10 p-6 sm:p-8">
            <div class="hazard-stripe-sm"></div>
            <div class="mt-2 grid grid-cols-2 gap-4 divide-x divide-white/5">
              <div class="pr-4">
                <div class="font-mono text-[10px] uppercase tracking-widest text-bm-gray-light">Armada Siap</div>
                <div class="mt-1 font-display font-black text-[32px] leading-none text-white">120+</div>
                <div class="mt-1 font-mono text-[10px] text-bm-gray-light">Unit aktif + GPS</div>
              </div>
              <div class="pl-4">
                <div class="font-mono text-[10px] uppercase tracking-widest text-bm-gray-light">Jangkauan</div>
                <div class="mt-1 font-display font-black text-[32px] leading-none text-bm-yellow">15+</div>
                <div class="mt-1 font-mono text-[10px] text-bm-gray-light">Kota di Indonesia</div>
              </div>
            </div>
            <div class="mt-6 flex items-center gap-3 bg-bm-black p-3 border border-white/5">
              <span class="w-2 h-2 bg-bm-yellow rounded-full animate-pulse"></span>
              <span class="font-mono text-[11px] text-bm-gray-light">Operasional 24/7 — Dispatch pusat Palembang</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Ticker --}}
  <div class="border-y border-white/5 bg-bm-black-light overflow-hidden">
    <div class="flex animate-marquee whitespace-nowrap py-2 font-mono text-[11px] uppercase tracking-[0.2em] text-bm-gray-light">
      <span class="mx-6">● TRUCKING SUMATERA—JAWA—BALI ● SEA FREIGHT MERAK—BAKAUHENI ● WAREHOUSING 5.000M² PALEMBANG ● GPS REAL-TIME ● ASURANSI ALL-RISK ● DISPATCH 24/7</span>
      <span class="mx-6">● TRUCKING SUMATERA—JAWA—BALI ● SEA FREIGHT MERAK—BAKAUHENI ● WAREHOUSING 5.000M² PALEMBANG ● GPS REAL-TIME ● ASURANSI ALL-RISK ● DISPATCH 24/7</span>
    </div>
  </div>
</section>

{{-- TENTANG KAMI --}}
<section id="about" class="py-16 lg:py-20 bg-bm-black border-y border-white/5">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-[1fr_1fr] gap-12 items-center">
      <div>
        <div class="label-industrial">Tentang Kami</div>
        <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">
          Logistik &<br>transportasi<br><span class="text-bm-yellow">terpercaya.</span>
        </h2>
        <p class="mt-4 text-[15px] leading-relaxed text-bm-white/80 max-w-[48ch]">
          PT Berkah Makmur Transport adalah penyedia jasa logistik dan transportasi yang berfokus pada ketepatan waktu, keandalan, dan transparansi biaya. Kami melayani pengiriman antarkota dan antar pulau untuk segmen B2B dan UMKM di seluruh Indonesia.
        </p>
        <a href="{{ route('about') }}" class="mt-6 inline-flex border border-white/15 px-5 py-3 font-display font-bold uppercase text-[13px] hover:bg-white hover:text-bm-black">Selengkapnya →</a>
      </div>

      @if($partners->isNotEmpty())
      <div>
        <div class="font-mono text-[11px] uppercase tracking-widest text-bm-gray-light mb-4">Partner & Klien</div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
          @foreach($partners as $p)
            <div class="border border-white/10 p-4 flex items-center justify-center bg-bm-black-soft">
              @if($p->logo)
                <img src="{{ asset('storage/'.$p->logo) }}" alt="{{ $p->name }}" class="max-h-10 object-contain">
              @else
                <span class="font-display font-bold text-[14px] uppercase text-bm-gray-light text-center leading-tight">{{ Str::of($p->name)->limit(20) }}</span>
              @endif
            </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
</section>

{{-- STRUKTUR PERUSAHAAN --}}
<section class="py-16 lg:py-20 bg-bm-black">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="label-industrial">Struktur Perusahaan</div>
    <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">
      Dewan Pengurus<br><span class="text-bm-yellow">PT BMT</span>
    </h2>
    <p class="mt-3 text-[14px] text-bm-white/60 max-w-[56ch]">Informasi resmi dewan pengurus PT Berkah Makmur Transport.</p>

    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @forelse($team->take(4) as $member)
        <div class="bg-bm-black-soft border border-white/10 p-6 text-center">
          <div class="w-20 h-20 mx-auto bg-bm-black-light border border-white/10 flex items-center justify-center font-display font-black text-[28px] text-bm-yellow">
            {{ Str::substr($member->name,0,1) }}
          </div>
          <div class="mt-4 font-mono text-[11px] uppercase tracking-widest text-bm-gray-light">{{ $member->position }}</div>
          <div class="mt-1 font-display font-bold uppercase text-[18px]">{{ $member->name }}</div>
          @if($member->bio)
            <p class="mt-2 text-[12px] text-bm-white/60 leading-relaxed line-clamp-2">{{ $member->bio }}</p>
          @endif
        </div>
      @empty
        @foreach([
          ['Direktur Utama', 'Alvie Yoga'],
          ['Direktur', 'Budi Santoso'],
          ['Koordinator Lapangan', 'Rudi Hermawan'],
          ['Administrator', 'Siti Rahma'],
        ] as $pos => $d)
          <div class="bg-bm-black-soft border border-white/10 p-6 text-center">
            <div class="w-20 h-20 mx-auto bg-bm-black-light border border-white/10 flex items-center justify-center font-display font-black text-[28px] text-bm-yellow">{{ Str::substr($d[1],0,1) }}</div>
            <div class="mt-4 font-mono text-[11px] uppercase tracking-widest text-bm-gray-light">{{ $d[0] }}</div>
            <div class="mt-1 font-display font-bold uppercase text-[18px]">{{ $d[1] }}</div>
            <p class="mt-2 text-[12px] text-bm-white/60 leading-relaxed">Memimpin arah strategis perusahaan dan pengembangan bisnis.</p>
          </div>
        @endforeach
      @endforelse
    </div>
  </div>
</section>

{{-- ARMADA teaser --}}
@php
  $waAll = \App\Models\SiteSetting::getValue('contact.whatsapp','6281234567890');
  $waAllMsg = rawurlencode('Halo BM Trans, saya ingin info armada. Bisa dibantu?');
@endphp
<section id="armada" class="py-16 lg:py-20 bg-bm-black border-y border-white/5 scroll-mt-24">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-6">
      <div>
        <div class="flex items-center gap-3">
          <span class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow font-bold">Armada</span>
          <span class="w-12 h-px bg-bm-yellow"></span>
        </div>
        <h2 class="mt-3 font-display font-black text-[36px] sm:text-[52px] leading-[0.85] uppercase">
          Armada siap jalan,<br>harga <span class="text-bm-yellow">transparan.</span>
        </h2>
      </div>
      <a href="{{ route('armada.index') }}" class="border border-white/15 px-5 py-3 font-display font-bold uppercase text-[13px] hover:bg-white hover:text-bm-black">Lihat semua →</a>
    </div>

    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 lg:gap-5">
      @if($armadas->isNotEmpty())
        @foreach($armadas->take(10) as $a)
          @php
            $waText = rawurlencode("Halo BM Trans, info harga {$a->name} (Mulai Rp {$a->display_price}) — rute saya: [isi rute]");
            $imgUrl = $a->image_url;
          @endphp
          <div class="group bg-bm-black-soft border border-white/10 overflow-hidden flex flex-col hover:border-bm-yellow/40 transition-colors">
            <div class="aspect-[16/10] bg-bm-black relative overflow-hidden">
              @if($imgUrl)
                <img src="{{ $imgUrl }}" alt="{{ $a->name }}" class="w-full h-full object-cover group-hover:scale-[1.05] transition duration-500" loading="lazy">
              @else
                <div class="w-full h-full flex items-center justify-center font-display font-black text-[42px] text-white/10">{{ Str::substr($a->name,0,2) }}</div>
              @endif
              <div class="absolute bottom-2 left-2">
                <span class="font-mono text-[9px] uppercase tracking-widest px-1.5 py-0.5 bg-bm-black/80 text-white border border-white/10">{{ $a->type ?: 'ARMADA' }}</span>
              </div>
            </div>
            <div class="p-4 flex flex-col flex-1 gap-2">
              <div class="font-display font-black text-[16px] leading-[0.9] uppercase text-white">{{ $a->name }}</div>
              <div>
                <div class="font-mono text-[9px] uppercase tracking-widest text-bm-white/50">Mulai dari</div>
                <div class="flex items-baseline gap-1"><span class="font-mono text-[10px] text-bm-gray-light">Rp</span><span class="font-display font-black text-[20px]">{{ $a->display_price }}</span></div>
              </div>
              <a href="https://wa.me/{{ $waAll }}?text={{ $waText }}" target="_blank" class="mt-auto inline-flex w-full justify-center bg-bm-yellow text-bm-black px-3 py-2.5 font-display font-bold uppercase text-[10px] leading-tight text-center hover:bg-white transition">Info Harga →</a>
            </div>
          </div>
        @endforeach
      @else
        @foreach([['Pickup','200rb'],['CDD Box','450rb'],['Fuso','1,2jt'],['Tronton','1,6jt'],['Wing Box','1,6jt']] as $row)
          @php $waText = rawurlencode("Halo BM Trans, info harga {$row[0]} (Mulai Rp {$row[1]}) — rute saya: [isi rute]"); @endphp
          <div class="bg-bm-black-soft border border-white/10 overflow-hidden flex flex-col">
            <div class="aspect-[16/10] bg-bm-black flex items-center justify-center font-display text-white/10 text-[32px]">{{ Str::substr($row[0],0,2) }}</div>
            <div class="p-4 flex flex-col flex-1">
              <div class="font-display font-black uppercase text-[15px] leading-[0.9]">{{ $row[0] }}</div>
              <div class="mt-2 font-mono text-[9px] opacity-60 uppercase">Mulai dari</div>
              <div class="font-display font-black text-[20px]">Rp {{ $row[1] }}</div>
              <a href="https://wa.me/{{ $waAll }}?text={{ $waText }}" target="_blank" class="mt-3 inline-flex w-full justify-center bg-bm-yellow text-bm-black px-3 py-2 font-display font-bold uppercase text-[10px] leading-tight text-center">Info Harga →</a>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <div class="mt-6 flex flex-wrap items-center gap-3 font-mono text-[11px]">
      <span class="px-3 py-1.5 bg-bm-yellow/10 border border-bm-yellow/20 text-bm-yellow">✓ Harga negotiable</span>
      <span class="px-3 py-1.5 border border-white/10 text-bm-gray-light">Chat admin untuk penawaran rute spesifik</span>
    </div>
  </div>
</section>

{{-- JANGKAUAN LAYANAN --}}
<section class="py-16 lg:py-20 bg-bm-black">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="label-industrial">Jangkauan</div>
    <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">
      Cakupan layanan<br><span class="text-bm-yellow">seluruh Indonesia.</span>
    </h2>

    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
      @foreach([
        ['Sumatera', 'Palembang, Lampung, Medan, Pekanbaru, Padang, Jambi, Bengkulu'],
        ['Jawa', 'Jakarta, Bandung, Semarang, Surabaya, Yogyakarta, Malang'],
        ['Kalimantan', 'Pontianak, Banjarmasin, Balikpapan, Samarinda'],
        ['Bali & Nusa', 'Denpasar, Mataram, seluruh Bali'],
      ] as $area)
        <div class="bg-bm-black-soft border border-white/10 p-6">
          <div class="font-display font-black text-[24px] uppercase text-bm-yellow">{{ $area[0] }}</div>
          <div class="mt-2 font-mono text-[12px] text-bm-gray-light">{{ $area[1] }}</div>
        </div>
      @endforeach
    </div>
    <div class="mt-4 bg-bm-black-soft border border-white/10 p-4 font-mono text-[12px] text-bm-gray-light text-center">
      Jabodetabek, Bandung, Jawa, Sumatera, Kalimantan, Sulawesi, Bali — Klik <a href="{{ route('contact') }}" class="text-bm-yellow underline">Hubungi Kami</a> untuk detail cakupan area spesifik.
    </div>
  </div>
</section>

{{-- TESTIMONI --}}
<section class="py-16 lg:py-20 bg-bm-black border-y border-white/5">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      <div class="label-industrial">Testimoni</div>
      <div class="h-px w-16 bg-bm-yellow/30"></div>
    </div>
    <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">
      Kata mereka yang<br><span class="text-bm-yellow">percaya pada kami.</span>
    </h2>

    <div class="mt-10 grid md:grid-cols-2 gap-5">
      @forelse($testimonials as $t)
        <div class="bg-bm-black-soft border border-white/5 p-6 flex gap-4">
          <div class="w-12 h-12 bg-bm-white/10 flex items-center justify-center font-display font-bold text-lg shrink-0">{{ Str::substr($t->name,0,1) }}</div>
          <div>
            <div class="font-display font-bold uppercase text-[15px]">{{ $t->name }} <span class="font-body normal-case font-normal text-bm-gray-light text-[12px]">• {{ $t->company }}</span></div>
            <div class="mt-1 text-[13px] text-bm-white/80 leading-relaxed">"{{ $t->quote }}"</div>
          </div>
        </div>
      @empty
        <div class="bg-bm-black-soft border border-white/5 p-6 flex gap-4">
          <div class="w-12 h-12 bg-bm-white/10 flex items-center justify-center font-display font-bold text-lg">S</div>
          <div>
            <div class="font-display font-bold uppercase">PT Sumber Makmur Abadi <span class="font-body normal-case text-bm-gray-light text-[12px]">• Palembang</span></div>
            <div class="mt-1 text-[13px] text-bm-white/80">"Sudah 3 tahun pakai BM Trans untuk distribusi. On-time, driver disiplin, komunikasi lancar."</div>
          </div>
        </div>
        <div class="bg-bm-black-soft border border-white/5 p-6 flex gap-4">
          <div class="w-12 h-12 bg-bm-white/10 flex items-center justify-center font-display font-bold text-lg">C</div>
          <div>
            <div class="font-display font-bold uppercase">CV Logistik Baja <span class="font-body normal-case text-bm-gray-light text-[12px]">• Cilegon</span></div>
            <div class="mt-1 text-[13px] text-bm-white/80">"Muatan butuh handling khusus. BM Trans handlingnya rapi dan profesional."</div>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- GALERI / AKTIVITAS LAPANGAN --}}
@if($gallery->isNotEmpty())
<section class="py-16 lg:py-20 bg-bm-black">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between">
      <div>
        <div class="label-industrial">Aktivitas Lapangan</div>
        <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">Dokumentasi<br><span class="text-bm-yellow">operasional.</span></h2>
      </div>
      <a href="{{ route('gallery') }}" class="border border-white/15 px-5 py-3 font-display uppercase text-[13px] hover:bg-white hover:text-bm-black">Lihat semua →</a>
    </div>

    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
      @foreach($gallery->take(8) as $item)
        <div class="group relative bg-bm-black-soft border border-white/5 overflow-hidden">
          <div class="aspect-[4/3] bg-bm-black-light">
            @if($item->type === 'image')
              <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->alt_text ?? $item->title }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition duration-500" loading="lazy">
            @else
              <div class="w-full h-full flex items-center justify-center font-mono text-[11px] text-bm-gray-light">VIDEO</div>
            @endif
          </div>
          <div class="p-3">
            <div class="font-mono text-[10px] text-bm-yellow uppercase">{{ $item->category }}</div>
            <div class="font-display uppercase text-[13px] truncate">{{ $item->title }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ARTIKEL --}}
<section class="py-16 lg:py-20 bg-bm-black border-y border-white/5">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between">
      <div>
        <div class="label-industrial">Artikel</div>
        <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">Insight &<br><span class="text-bm-yellow">panduan logistik.</span></h2>
      </div>
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

{{-- FAQ --}}
<section class="py-16 lg:py-20 bg-bm-black">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <div class="label-industrial justify-center">FAQ</div>
      <h2 class="mt-3 font-display font-black text-[36px] sm:text-[48px] leading-[0.85] uppercase">Pertanyaan<br><span class="text-bm-yellow">umum.</span></h2>
    </div>

    @php
      $faqs = [
        'Layanan & SLA' => [
          'Proses pengirimannya berapa lama?' => 'Tergantung rute. Palembang—Jakarta estimasi 2–3 hari, Palembang—Surabaya 3–5 hari. Hubungi kami untuk estimasi tepat sesuai rute Anda.',
          'Apakah ada layanan same-day atau ekspres?' => 'Ya, untuk rute dalam kota Palembang dan Jakarta tersedia layanan same-day. Biaya menyesuaikan.',
        ],
        'Tarif & Pembayaran' => [
          'Bagaimana perhitungan tarif?' => 'Tarif dihitung berdasarkan berat atau volume (diambil yang lebih besar). Untuk barang ringan namun besar, volume dikonversi ke berat ekuivalen.',
          'Metode pembayaran apa yang didukung?' => 'Transfer bank (BCA, Mandiri, BRI) tersedia. Untuk korporat dapat dilakukan termin 30 hari dengan perjanjian.',
        ],
        'Pickup & Pengantaran' => [
          'Apakah ada jasa pickup di lokasi?' => 'Ya, kami menjemput barang ke lokasi Anda. Biaya pickup menyesuaikan jarak dari pool terdekat.',
          'Apakah penerima bisa jadwalkan ulang pengantaran?' => 'Bisa. Hubungi CS kami minimal H-1 untuk perubahan jadwal.',
        ],
      ];
    @endphp

    <div class="max-w-[800px] mx-auto space-y-4">
      @foreach($faqs as $group => $items)
        <div class="bg-bm-black-soft border border-white/10">
          <div class="p-4 font-display font-bold uppercase text-[15px] text-bm-yellow border-b border-white/5">{{ $group }}</div>
          <div class="divide-y divide-white/5">
            @foreach($items as $q => $a)
              <div class="faq-item">
                <button class="faq-toggle w-full flex items-center justify-between p-4 text-left hover:bg-white/5 transition">
                  <span class="text-[14px] text-bm-white/90 pr-4">{{ $q }}</span>
                  <svg class="w-4 h-4 text-bm-yellow shrink-0 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 9l6 6 6-6" stroke-width="2"/></svg>
                </button>
                <div class="faq-answer hidden px-4 pb-4">
                  <p class="text-[13px] text-bm-gray-light leading-relaxed">{{ $a }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="relative bg-bm-red overflow-hidden">
  <div class="hazard-stripe"></div>
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 py-14 lg:py-20 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
    <div>
      <div class="font-mono text-[11px] uppercase tracking-widest text-white/70">Siap kirim hari ini?</div>
      <h2 class="mt-2 font-display font-black text-[40px] sm:text-[52px] leading-[0.85] uppercase text-white">Hubungi tim kami<br>untuk penawaran <span class="bg-bm-black px-2">terbaik.</span></h2>
    </div>
    <div class="flex flex-col sm:flex-row gap-3">
      <a href="https://wa.me/{{ \App\Models\SiteSetting::getValue('contact.whatsapp','6281234567890') }}" target="_blank" class="bg-black text-white px-8 py-4 font-display font-bold uppercase text-[14px] tracking-wide clip-notch inline-flex items-center gap-3">WhatsApp <span>→</span></a>
      <a href="{{ route('contact') }}" class="bg-white text-bm-black px-8 py-4 font-display font-bold uppercase text-[14px]">Form Penawaran</a>
    </div>
  </div>
</section>

@push('scripts')
<script>
document.querySelectorAll('.faq-toggle').forEach(btn => {
  btn.addEventListener('click', () => {
    const answer = btn.nextElementSibling;
    const icon = btn.querySelector('svg');
    const isOpen = !answer.classList.contains('hidden');
    answer.classList.toggle('hidden');
    icon.style.transform = isOpen ? '' : 'rotate(180deg)';
  });
});
</script>
@endpush

@push('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => 'PT Berkah Makmur Transport',
  'url' => request()->root(),
  'logo' => asset('images/logo.png'),
  'description' => 'Jasa logistik dan transportasi Indonesia — pengiriman darat, laut, dan pergudangan.',
  'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Palembang', 'addressCountry' => 'ID']
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush
@endsection
