@php
  $services = \App\Models\Service::active()->ordered()->take(4)->get();
  $set = fn($k,$d='') => \App\Models\SiteSetting::getValue($k,$d);
  $logo = \App\Models\SiteSetting::getValue('branding.logo');
@endphp

<footer class="relative mt-24 bg-bm-black-soft border-t border-white/10 overflow-hidden">
  {{-- hazard --}}
  <div class="hazard-stripe"></div>

  {{-- big watermark --}}
  <div class="pointer-events-none absolute -bottom-10 -right-10 font-display font-black text-[18vw] leading-none text-white/[0.02] uppercase select-none">BMTRANS</div>

  <div class="relative mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid lg:grid-cols-[1.2fr_1fr_1fr_1fr] gap-10 lg:gap-8">
      {{-- Brand --}}
      <div>
        <div class="flex items-center gap-3">
          @if($logo)
            <div class="w-12 h-12 bg-bm-black border border-white/10 flex items-center justify-center overflow-hidden shrink-0">
              <img src="{{ asset('storage/'.$logo) }}" alt="Logo Berkah Makmur Transport" class="w-full h-full object-contain">
            </div>
          @else
            <div class="w-12 h-12 bg-bm-red flex items-center justify-center font-display font-black text-xl">BM</div>
          @endif
          <div class="leading-[0.9]">
            <div class="font-display font-black text-[20px] uppercase">Berkah Makmur</div>
            <div class="font-display font-black text-[20px] uppercase -mt-1 text-bm-yellow">Transport</div>
          </div>
        </div>
        <p class="mt-4 text-[13px] leading-relaxed text-bm-gray-light max-w-[34ch]">
          Jasa logistik dan transportasi terpercaya sejak 2010. Armada lengkap dari pickup hingga tronton dengan jangkauan Sumatera–Jawa–Bali–Kalimantan.
        </p>
        <div class="mt-6 flex gap-2">
          <span class="px-3 py-1 bg-bm-yellow text-bm-black font-mono text-[10px] uppercase tracking-widest font-bold">TERPERCAYA</span>
          <span class="px-3 py-1 border border-white/10 font-mono text-[10px] uppercase tracking-widest">SIUP • TDP • NPWP</span>
        </div>
        @php
          $ig = $set('social.instagram');
          $tt = $set('social.tiktok');
        @endphp
        @if($ig || $tt)
          <div class="mt-5 flex gap-2">
            @if($ig)
              <a href="{{ $ig }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-2 border border-white/10 hover:border-bm-yellow hover:text-bm-yellow transition-colors font-mono text-[10px] uppercase tracking-widest" aria-label="Instagram">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Instagram
              </a>
            @endif
            @if($tt)
              <a href="{{ $tt }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-2 border border-white/10 hover:border-bm-yellow hover:text-bm-yellow transition-colors font-mono text-[10px] uppercase tracking-widest" aria-label="TikTok">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1v-3.5a6.37 6.37 0 00-.79-.05A6.34 6.34 0 003.15 15.8a6.34 6.34 0 0010.86 4.48V13.3a8.16 8.16 0 005.58 2.18v-3.45a4.85 4.85 0 01-3.55-1.34z"/></svg>
                TikTok
              </a>
            @endif
          </div>
        @endif
        <div class="mt-8 font-mono text-[11px] text-bm-gray-light">
          <div>📍 {{ $set('contact.address', 'Jl. Lintas Timur KM 12, Palembang, Sumsel 30151') }}</div>
          <div class="mt-2">© <span id="current-year">{{ date('Y') }}</span> PT Berkah Makmur Transport • All rights reserved</div>
        </div>
      </div>

      {{-- Layanan --}}
      <div>
        <div class="label-industrial mb-4">Layanan</div>
        <ul class="space-y-2">
          @foreach($services as $s)
            <li><a href="{{ route('layanan.show', $s->slug) }}" class="text-[14px] text-bm-white/70 hover:text-bm-yellow hover:pl-1 transition-all">{{ $s->title }}</a></li>
          @endforeach
          <li><a href="{{ route('armada.index') }}" class="text-[14px] text-bm-white/70 hover:text-bm-yellow hover:pl-1 transition-all">Armada & Harga</a></li>
          <li class="pt-2"><a href="{{ route('layanan.index') }}" class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">Index Layanan →</a></li>
        </ul>
      </div>

      {{-- Explore --}}
      <div>
        <div class="label-industrial mb-4">Jelajah</div>
        <ul class="space-y-2 text-[14px] text-bm-white/70">
          <li><a href="{{ route('about') }}" class="hover:text-bm-white">Tentang Kami & Legalitas</a></li>
          <li><a href="{{ route('gallery') }}" class="hover:text-bm-white">Galeri Armada & Gudang</a></li>
          <li><a href="{{ route('articles.index') }}" class="hover:text-bm-white">Artikel & Insight</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-bm-white">Hubungi & Cabang</a></li>
        </ul>
        <div class="mt-6 p-3 bg-bm-black border border-bm-yellow/20">
          <div class="font-mono text-[10px] uppercase tracking-widest text-bm-yellow">Dispatch hotline</div>
          <a href="tel:{{ $set('contact.phone') }}" class="font-display font-bold text-[18px]">{{ $set('contact.phone', '+62 812-xxxx-xxxx') }}</a>
          <div class="mt-1 h-px bg-bm-yellow/30"></div>
          <div class="mt-1 font-mono text-[11px] text-bm-gray-light">Senin–Sabtu 06:00–20:00 WIB</div>
        </div>
      </div>

      {{-- CTA --}}
      <div class="bg-bm-black border border-white/10 p-5">
        <div class="label-industrial">Butuh bantuan?</div>
        <h3 class="mt-2 font-display font-black text-[28px] leading-[0.9] uppercase">Hubungi kami<br><span class="text-bm-red">sekarang</span></h3>
        <p class="mt-3 text-[13px] text-bm-gray-light">Tim kami siap bantu kebutuhan logistik Anda.</p>
        <a href="{{ route('contact') }}" class="mt-5 inline-flex w-full justify-between items-center bg-bm-red px-4 py-3 font-display font-bold uppercase text-[13px] hover:bg-bm-red-dark">
          <span>Hubungi Kami</span>
          <span>→</span>
        </a>
        <div class="mt-4 flex gap-2 font-mono text-[10px]">
          <span class="px-2 py-1 bg-bm-yellow/10 text-bm-yellow border border-bm-yellow/20">DARAT</span>
          <span class="px-2 py-1 bg-white/5">LAUT</span>
          <span class="px-2 py-1 bg-white/5">GUDANG</span>
        </div>
      </div>
    </div>
  </div>

  <div class="border-t border-white/5">
    <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 font-mono text-[10px] uppercase tracking-widest text-bm-gray-light">
      <div class="flex flex-wrap gap-4">
        <a href="/sitemap.xml" class="hover:text-bm-white">Sitemap</a>
        <a href="/robots.txt" class="hover:text-bm-white">Robots</a>
        <span>PT Berkah Makmur Transport — Jasa Logistik & Transportasi Indonesia</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Operasional 24/7 • {{ \App\Models\SiteSetting::getValue('stats.total_shipments','12.000+') }} pengiriman
      </div>
    </div>
  </div>
</footer>
