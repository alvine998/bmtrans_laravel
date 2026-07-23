@php
  $services = \App\Models\Service::active()->ordered()->take(5)->get();
  $settings = [
    'phone' => \App\Models\SiteSetting::getValue('contact.phone', '+62 812-3456-7890'),
    'wa' => \App\Models\SiteSetting::getValue('contact.whatsapp', '6281234567890'),
    'email' => \App\Models\SiteSetting::getValue('contact.email', 'info@berkahmakmurtransport.co.id'),
  ];
  $logo = \App\Models\SiteSetting::getValue('branding.logo');
@endphp

<header class="sticky top-2 z-50 w-full">
  {{-- Utility bar - industrial --}}
  <div class="bg-bm-black-soft border-y border-white/5">
    <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 flex items-center justify-between py-2">
      <div class="flex items-center gap-6 font-mono text-[10px] sm:text-[11px] uppercase tracking-widest text-bm-gray-light">
        <span class="hidden sm:inline-flex items-center gap-2">
          <span class="w-1.5 h-1.5 bg-bm-yellow rounded-full animate-pulse"></span>
          Armada aktif 24/7 — Monitoring GPS real-time
        </span>
        <span class="inline-flex sm:hidden">OPERASIONAL 24/7</span>
      </div>
      <div class="flex items-center gap-4 text-[11px]">
        <a href="tel:{{ $settings['phone'] }}" class="hover:text-bm-yellow transition">{{ $settings['phone'] }}</a>
        <a href="https://wa.me/{{ $settings['wa'] }}" target="_blank" rel="noopener" class="hidden sm:inline-flex bg-bm-yellow text-bm-black px-3 py-1 font-bold uppercase tracking-wide hover:bg-bm-yellow-dark">WA Sekarang</a>
      </div>
    </div>
  </div>

  {{-- Main nav - asymmetric industrial --}}
  <nav class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 relative">
    {{-- Nav shell: clip-diagonal but overflow visible handling --}}
    <div class="mt-3 flex items-center justify-between bg-bm-black-light border border-white/10 pr-1 sm:pr-2 relative nav-shell">
      {{-- Logo block --}}
      <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 group">
        @if($logo)
          <div class="w-10 h-10 bg-bm-black-light border border-white/10 flex items-center justify-center overflow-hidden shrink-0">
            <img src="{{ asset('storage/'.$logo) }}" alt="Logo Berkah Makmur Transport" class="w-full h-full object-contain">
          </div>
        @else
          <div class="w-10 h-10 bg-bm-red flex items-center justify-center font-display font-black text-xl leading-none group-hover:bg-bm-yellow group-hover:text-bm-black transition-colors">BM</div>
        @endif
        <div class="leading-[0.9]">
          <div class="font-display font-black text-[18px] sm:text-[20px] uppercase tracking-tight">Berkah Makmur</div>
          <div class="font-mono text-[9px] uppercase tracking-[0.25em] text-bm-yellow">Transport • EST 2010</div>
        </div>
      </a>

      {{-- Desktop links --}}
      <div class="hidden lg:flex items-center gap-1 pr-2">
        <a href="{{ route('home') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow {{ request()->routeIs('home') ? 'text-bm-yellow' : 'text-bm-white/80' }}">Beranda</a>

        {{-- Layanan dropdown --}}
        <div class="relative" id="layanan-dropdown-wrapper">
          <button id="layanan-toggle" data-dropdown-toggle="layanan-dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="layanan-dropdown" class="flex items-center gap-2 px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide text-bm-white/80 hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50">
            Layanan
            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" class="transition-transform duration-200" data-dropdown-icon><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2"/></svg>
          </button>
          {{-- Dropdown outside clipped ancestor visually but same wrapper; positioned absolute with overflow fix --}}
          <div id="layanan-dropdown" data-dropdown role="menu" aria-labelledby="layanan-toggle" class="hidden absolute left-0 top-full mt-3 min-w-[360px] bg-bm-black-soft border border-white/10 shadow-[0_20px_60px_rgba(0,0,0,0.6)] z-[60] opacity-0 translate-y-1 transition-all duration-200">
            <div class="hazard-stripe-sm"></div>
            <div class="p-2">
              @forelse($services as $svc)
                <a href="{{ route('layanan.show', $svc->slug) }}" role="menuitem" tabindex="0" class="flex items-start gap-3 px-4 py-3 hover:bg-bm-white/5 focus:bg-bm-white/5 focus:outline-none group/item">
                  <span class="font-mono text-[10px] text-bm-yellow mt-1">0{{ $loop->iteration }}</span>
                  <div>
                    <div class="font-display font-bold uppercase text-[14px] group-hover/item:text-bm-yellow group-focus:text-bm-yellow">{{ $svc->title }}</div>
                    <div class="text-[12px] text-bm-gray-light line-clamp-1">{{ $svc->excerpt }}</div>
                  </div>
                </a>
              @empty
                <div class="px-4 py-3 text-sm text-bm-gray-light">Layanan belum tersedia</div>
              @endforelse
              <div class="border-t border-white/5 mt-2 pt-3 px-2 pb-2 flex items-center justify-between">
                <a href="{{ route('layanan.index') }}" class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow hover:underline">Lihat semua layanan →</a>
                <span class="font-mono text-[10px] text-bm-gray-light">ESC untuk tutup</span>
              </div>
            </div>
          </div>
        </div>

        <a href="{{ route('armada.index') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow {{ request()->routeIs('armada.*') ? 'text-bm-yellow' : 'text-bm-white/80' }}">Armada & Harga</a>
        <a href="{{ route('about') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50 {{ request()->routeIs('about') ? 'text-bm-yellow' : 'text-bm-white/80' }}">Tentang Kami</a>
        <a href="{{ route('gallery') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50 {{ request()->routeIs('gallery') ? 'text-bm-yellow' : 'text-bm-white/80' }}">Galeri</a>
        <a href="{{ route('articles.index') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50 {{ request()->routeIs('articles.*') ? 'text-bm-yellow' : 'text-bm-white/80' }}">Artikel</a>
        <a href="{{ route('contact') }}" class="ml-2 bg-bm-red text-white px-5 py-2.5 font-display font-bold uppercase text-[13px] tracking-wide hover:bg-bm-red-dark transition clip-notch focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-red">Hubungi Kami</a>
      </div>

      {{-- Mobile toggle --}}
      <button id="nav-toggle" aria-expanded="false" aria-controls="nav-menu" class="lg:hidden p-3 mr-1 border border-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50">
        <span class="sr-only">Menu</span>
        <svg width="20" height="14" viewBox="0 0 20 14" fill="none" class="text-white"><path d="M0 1H20M0 7H20M0 13H20" stroke="currentColor" stroke-width="1.5"/></svg>
      </button>

      {{-- Diagonal cut visual only — separate element to not clip dropdown --}}
      <span aria-hidden="true" class="pointer-events-none absolute right-0 top-0 w-[40px] h-[40px] bg-bm-black-light hidden sm:block" style="clip-path: polygon(calc(100% - 40px) 0, 100% 0, 100% 40px); transform: translate(1px, -1px);"></span>
      <span aria-hidden="true" class="pointer-events-none absolute right-0 bottom-0 w-[40px] h-[40px] bg-bm-black-light" style="clip-path: polygon(100% 40px, 100% 100%, calc(100% - 0px) 100%);"></span>
    </div>

    {{-- Mobile menu --}}
    <div id="nav-menu" class="hidden lg:hidden flex-col mt-2 bg-bm-black-soft border border-white/10 absolute left-4 right-4 sm:left-6 sm:right-6 z-[55] shadow-2xl">
      <div class="hazard-stripe-sm"></div>
      <div class="p-4 flex flex-col gap-1">
        <a href="{{ route('home') }}" class="py-3 font-display font-bold uppercase text-[16px] border-b border-white/5 focus:outline-none focus-visible:bg-white/5">Beranda</a>
        <div class="py-2">
          <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow mb-2 flex items-center justify-between">
            <span>Layanan</span>
            <button id="mobile-layanan-toggle" aria-expanded="false" class="border border-white/10 px-2 py-1 text-[10px]">Buka</button>
          </div>
          <div id="mobile-layanan-list" class="hidden flex-col">
            @foreach($services as $svc)
              <a href="{{ route('layanan.show', $svc->slug) }}" class="block py-2 px-3 font-display uppercase text-[15px] hover:bg-white/5 focus:bg-white/5 focus:outline-none">{{ $svc->title }}</a>
            @endforeach
            <a href="{{ route('layanan.index') }}" class="block py-2 px-3 font-mono text-[11px] text-bm-yellow uppercase">Lihat semua →</a>
          </div>
        </div>
        <a href="{{ route('armada.index') }}" class="py-3 font-display font-bold uppercase text-[16px] border-y border-white/5 {{ request()->routeIs('armada.*') ? 'text-bm-yellow' : '' }}">Armada & Harga</a>
        <a href="{{ route('about') }}" class="py-3 font-display font-bold uppercase text-[16px] border-y border-white/5 focus:outline-none">Tentang Kami</a>
        <a href="{{ route('gallery') }}" class="py-3 font-display font-bold uppercase text-[16px] border-b border-white/5">Galeri</a>
        <a href="{{ route('articles.index') }}" class="py-3 font-display font-bold uppercase text-[16px] border-b border-white/5">Artikel</a>
        <a href="{{ route('contact') }}" class="mt-2 bg-bm-red text-white px-5 py-3 font-display font-bold uppercase text-center">Hubungi Kami</a>
        <div class="flex gap-3 pt-4">
          <a href="tel:{{ $settings['phone'] }}" class="flex-1 border border-white/10 py-2 text-center text-[12px]">{{ $settings['phone'] }}</a>
          <a href="https://wa.me/{{ $settings['wa'] }}" class="flex-1 bg-bm-yellow text-bm-black py-2 text-center font-bold text-[12px]">WhatsApp</a>
        </div>
      </div>
    </div>
  </nav>
</header>
