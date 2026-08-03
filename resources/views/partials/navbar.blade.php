@php
  $settings = [
    'phone' => \App\Models\SiteSetting::getValue('contact.phone', '+62 812-3456-7890'),
    'wa' => \App\Models\SiteSetting::getValue('contact.whatsapp', '6281234567890'),
    'email' => \App\Models\SiteSetting::getValue('contact.email', 'info@berkahmakmurtransport.co.id'),
  ];
  $logo = \App\Models\SiteSetting::getValue('branding.logo');
@endphp

<header class="sticky top-2 z-50 w-full">
  {{-- Utility bar - industrial --}}
  <div class="bg-bm-cream-soft border-y border-bm-dark/5">
    <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 flex items-center justify-between py-2">
      <div class="flex items-center gap-6 font-mono text-[10px] sm:text-[11px] uppercase tracking-widest text-bm-gray-light">
        <span class="hidden sm:inline-flex items-center gap-2">
          <span class="w-1.5 h-1.5 bg-bm-yellow rounded-full animate-pulse"></span>
          Logistik & transportasi — 24/7 siap bantu
        </span>
        <span class="inline-flex sm:hidden">LOGISTIK 24/7</span>
      </div>
      <div class="flex items-center gap-4 text-[11px]">
        <a href="tel:{{ $settings['phone'] }}" class="hover:text-bm-yellow transition">{{ $settings['phone'] }}</a>
        <a href="https://wa.me/{{ $settings['wa'] }}" target="_blank" rel="noopener" class="hidden sm:inline-flex bg-bm-yellow text-bm-dark px-3 py-1 font-bold uppercase tracking-wide hover:bg-bm-yellow-dark">WA Sekarang</a>
      </div>
    </div>
  </div>

  {{-- Main nav - asymmetric industrial --}}
  <nav class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 relative">
    {{-- Nav shell: clip-diagonal but overflow visible handling --}}
    <div class="mt-3 flex items-center justify-between bg-bm-cream-light border border-bm-dark/10 pr-1 sm:pr-2 relative nav-shell">
      {{-- Logo block --}}
      <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 group">
        @if($logo)
          <div class="w-10 h-10 bg-bm-cream-light border border-bm-dark/10 flex items-center justify-center overflow-hidden shrink-0">
            <img src="{{ asset('storage/'.$logo) }}" alt="Logo Berkah Makmur Transport" class="w-full h-full object-contain">
          </div>
        @else
          <div class="w-10 h-10 bg-bm-red flex items-center justify-center font-display font-black text-xl leading-none group-hover:bg-bm-yellow group-hover:text-bm-dark transition-colors">BM</div>
        @endif
        <div class="leading-[0.9]">
          <div class="flex items-center gap-2">
            <span class="text-[18px] sm:text-[20px] uppercase tracking-tight" style="font-family:'Poppins',sans-serif;font-weight:600">PT Berkah Makmur</span>
          </div>
          <div class="mt-1 font-mono text-[9px] uppercase tracking-[0.25em] text-bm-yellow">Transport • EST 2017</div>
        </div>
      </a>

      {{-- Desktop links --}}
      <div class="hidden lg:flex items-center gap-1 pr-2">
        <a href="{{ route('home') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow {{ request()->routeIs('home') ? 'text-bm-yellow' : 'text-bm-dark/80' }}">Beranda</a>

        <a href="{{ route('armada.index') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow {{ request()->routeIs('armada.*') ? 'text-bm-yellow' : 'text-bm-dark/80' }}">Armada & Harga</a>
        <a href="{{ route('about') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50 {{ request()->routeIs('about') ? 'text-bm-yellow' : 'text-bm-dark/80' }}">Tentang Kami</a>
        <a href="{{ route('gallery') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50 {{ request()->routeIs('gallery') ? 'text-bm-yellow' : 'text-bm-dark/80' }}">Galeri</a>
        <a href="{{ route('articles.index') }}" class="px-4 py-2 font-display font-bold uppercase text-[13px] tracking-wide hover:text-bm-yellow focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50 {{ request()->routeIs('articles.*') ? 'text-bm-yellow' : 'text-bm-dark/80' }}">Artikel</a>
        <a href="{{ route('contact') }}" class="ml-2 bg-bm-red text-white px-5 py-2.5 font-display font-bold uppercase text-[13px] tracking-wide hover:bg-bm-red-dark transition clip-notch focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-red">Hubungi Kami</a>
      </div>

      {{-- Mobile toggle --}}
      <button id="nav-toggle" aria-expanded="false" aria-controls="nav-menu" class="lg:hidden p-3 mr-1 border border-bm-dark/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-bm-yellow/50">
        <span class="sr-only">Menu</span>
        <svg width="20" height="14" viewBox="0 0 20 14" fill="none" class="text-bm-dark"><path d="M0 1H20M0 7H20M0 13H20" stroke="currentColor" stroke-width="1.5"/></svg>
      </button>

      {{-- Diagonal cut visual only — separate element to not clip dropdown --}}
      <span aria-hidden="true" class="pointer-events-none absolute right-0 top-0 w-[40px] h-[40px] bg-bm-cream-light hidden sm:block" style="clip-path: polygon(calc(100% - 40px) 0, 100% 0, 100% 40px); transform: translate(1px, -1px);"></span>
      <span aria-hidden="true" class="pointer-events-none absolute right-0 bottom-0 w-[40px] h-[40px] bg-bm-cream-light" style="clip-path: polygon(100% 40px, 100% 100%, calc(100% - 0px) 100%);"></span>
    </div>

    {{-- Mobile menu --}}
    <div id="nav-menu" class="hidden lg:hidden flex-col mt-2 bg-bm-cream-soft border border-bm-dark/10 absolute left-4 right-4 sm:left-6 sm:right-6 z-[55] shadow-2xl">
      <div class="hazard-stripe-sm"></div>
      <div class="p-4 flex flex-col gap-1">
        <a href="{{ route('home') }}" class="py-3 font-display font-bold uppercase text-[16px] border-b border-bm-dark/5 focus:outline-none focus-visible:bg-bm-dark/5">Beranda</a>
        <a href="{{ route('armada.index') }}" class="py-3 font-display font-bold uppercase text-[16px] border-y border-bm-dark/5 {{ request()->routeIs('armada.*') ? 'text-bm-yellow' : '' }}">Armada & Harga</a>
        <a href="{{ route('about') }}" class="py-3 font-display font-bold uppercase text-[16px] border-y border-bm-dark/5 focus:outline-none">Tentang Kami</a>
        <a href="{{ route('gallery') }}" class="py-3 font-display font-bold uppercase text-[16px] border-b border-bm-dark/5">Galeri</a>
        <a href="{{ route('articles.index') }}" class="py-3 font-display font-bold uppercase text-[16px] border-b border-bm-dark/5">Artikel</a>
        <a href="{{ route('contact') }}" class="mt-2 bg-bm-red text-white px-5 py-3 font-display font-bold uppercase text-center">Hubungi Kami</a>
        <div class="flex gap-3 pt-4">
          <a href="tel:{{ $settings['phone'] }}" class="flex-1 border border-bm-dark/10 py-2 text-center text-[12px]">{{ $settings['phone'] }}</a>
          <a href="https://wa.me/{{ $settings['wa'] }}" class="flex-1 bg-bm-yellow text-bm-dark py-2 text-center font-bold text-[12px]">WhatsApp</a>
        </div>
      </div>
    </div>
  </nav>
</header>
