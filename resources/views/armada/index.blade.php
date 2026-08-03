@extends('layouts.app')

@section('content')
{{-- Hero — industrial --}}
<section class="relative bg-bm-cream overflow-hidden border-b border-bm-dark/5">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 80px 80px;"></div>
  <div class="absolute top-0 right-0 w-[60%] h-px bg-gradient-to-l from-bm-yellow/40 to-transparent hidden lg:block"></div>

  <div class="relative mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 pt-10 pb-12 lg:pt-14 lg:pb-16">
    <div class="flex items-center gap-3">
      <span class="w-12 h-px bg-bm-yellow"></span>
      <span class="font-mono text-[11px] uppercase tracking-[0.2em] text-bm-yellow">ARMADA • HARGA TRANSPARAN • INFO VIA WA</span>
    </div>

    <div class="mt-6 grid lg:grid-cols-[1.15fr_0.85fr] gap-8 items-start">
      <div>
        <h1 class="font-display font-black text-[44px] sm:text-[64px] lg:text-[80px] leading-[0.85] uppercase">
          Armada<br>
          <span class="text-bm-yellow">siap jalan</span><br>
          <span class="inline-block bg-bm-cream text-bm-dark px-3 py-1 -rotate-1">info harga</span>
        </h1>
        <p class="mt-6 max-w-[48ch] text-[15px] sm:text-[16px] leading-relaxed text-bm-dark/70">
          Harga di bawah adalah <b class="text-bm-dark">Mulai dari</b> untuk rute pendek / dalam kota. Antar kota, tonase, dan ukuran muatan mempengaruhi tarif akhir.
          Hubungi kami via WhatsApp <b class="text-bm-yellow">untuk informasi harga</b> sesuai rute Anda.
        </p>

        <div class="mt-6 flex flex-wrap gap-3 font-mono text-[11px]">
          <span class="px-3 py-1.5 border border-bm-dark/10 bg-bm-dark/5">✓ GPS real-time</span>
          <span class="px-3 py-1.5 border border-bm-dark/10 bg-bm-dark/5">✓ Asuransi all-risk opsional</span>
          <span class="px-3 py-1.5 border border-bm-yellow/30 bg-bm-yellow/10 text-bm-yellow">✓ Info via WA</span>
        </div>
      </div>

      <div class="relative bg-bm-cream-soft border border-bm-dark/10 clip-diagonal">
        <div class="hazard-stripe-sm"></div>
        <div class="p-6 sm:p-7">
          <div class="font-mono text-[11px] uppercase text-bm-yellow">Cara kerja harga</div>
          <div class="mt-4 space-y-4 font-mono text-[12px]">
            <div class="flex gap-3">
              <span class="w-6 h-6 bg-bm-cream/10 flex items-center justify-center font-bold">1</span>
              <span class="text-bm-dark/80">Pilih armada — lihat estimasi harga mulai</span>
            </div>
            <div class="flex gap-3">
              <span class="w-6 h-6 bg-bm-cream/10 flex items-center justify-center font-bold">2</span>
              <span class="text-bm-dark/80">Klik <b class="text-bm-yellow">Info Harga</b> — chat WA langsung terisi nama armada</span>
            </div>
            <div class="flex gap-3">
              <span class="w-6 h-6 bg-bm-yellow text-bm-dark flex items-center justify-center font-bold">3</span>
              <span class="text-bm-dark/80">Admin kasih penawaran sesuai rute & kebutuhan Anda</span>
            </div>
          </div>

          <div class="mt-6 flex gap-3">
            <a href="https://wa.me/{{ $whatsapp }}?text={{ $waMessage }}" target="_blank" class="flex-1 bg-bm-yellow text-bm-dark px-4 py-3 font-display font-bold uppercase text-[12px] text-center">Chat WA →</a>
            <a href="{{ route('contact') }}" class="px-4 py-3 border border-bm-dark/15 font-display uppercase text-[12px]">Form Kontak</a>
          </div>

          <div class="mt-4 bg-bm-cream border border-bm-dark/10 p-3 font-mono text-[10px] text-bm-gray-light">
            Catatan: Harga exclude tol, parkir, bongkar muat (jika ada). Armada standby Palembang • Jakarta • Surabaya.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Price list --}}
<section class="py-12 lg:py-16 bg-bm-cream text-bm-dark">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">

    @if($armadas->isEmpty())
      <div class="bg-bm-dark text-bm-cream p-8 border border-bm-dark/10 max-w-[60ch]">
        <h2 class="font-display font-black text-[24px] uppercase">Daftar armada belum tersedia</h2>
        <p class="mt-2 text-[14px] text-bm-dark/70">Admin sedang mengisi data armada. Hubungi WA untuk harga cepat.</p>
        <a href="https://wa.me/{{ $whatsapp }}" class="mt-4 inline-block bg-bm-yellow text-bm-dark px-4 py-2 font-display uppercase text-[12px]">Chat WA</a>
      </div>
    @else

      {{-- Quick filter by type --}}
      <div class="flex flex-wrap items-center gap-2 pb-6 border-b border-bm-dark/10">
        <span class="font-mono text-[11px] uppercase tracking-widest font-bold">Filter:</span>
        <button data-filter="all" class="filter-btn is-active px-3 py-1.5 border border-bm-dark bg-bm-dark text-bm-cream font-mono text-[11px] uppercase">Semua ({{ $armadas->count() }})</button>
        @foreach($grouped->keys() as $type)
          <button data-filter="{{ \Illuminate\Support\Str::slug($type) }}" class="filter-btn px-3 py-1.5 border border-bm-dark/15 font-mono text-[11px] uppercase hover:bg-bm-dark hover:text-bm-cream">{{ $type }} ({{ $grouped[$type]->count() }})</button>
        @endforeach
      </div>

      <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6" id="armada-grid">
        @foreach($armadas as $a)
          @php
            $typeSlug = \Illuminate\Support\Str::slug($a->type ?: 'lainnya');
            $waText = rawurlencode("Halo BM Trans, saya ingin negosiasi harga untuk armada {$a->name} ({$a->display_price}). Rute saya: [isi rute], tonase: [isi]. Mohon penawaran terbaik.");
            $img = $a->image_url;
          @endphp

          <div data-type="{{ $typeSlug }}" class="armada-card group relative bg-white border border-bm-dark/10 p-0 flex flex-col overflow-hidden hover:border-bm-dark/25 hover:shadow-[0_10px_40px_rgba(0,0,0,0.08)] transition-all duration-300">
            {{-- hazard accent --}}
            <div class="h-[5px] w-full bg-bm-yellow"></div>
            <div class="p-6 sm:p-7 flex flex-col flex-1">
              {{-- Top meta --}}
              <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-2">
                  <span class="font-mono text-[10px] uppercase tracking-widest px-2 py-1 bg-bm-dark text-bm-cream">{{ $a->type ?: 'ARMADA' }}</span>
                  <span class="font-mono text-[10px] text-bm-gray-light">{{ sprintf('%02d', $loop->iteration) }}</span>
                </div>
                <span class="w-6 h-6 border border-bm-dark/10 flex items-center justify-center group-hover:bg-bm-dark group-hover:text-bm-cream transition">↗</span>
              </div>

              <div class="mt-5 aspect-[16/10] bg-bm-cream-light overflow-hidden border border-bm-dark/5">
                @if($img)
                  <img src="{{ $img }}" alt="{{ $a->name }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition duration-500" loading="lazy">
                @else
                  <div class="w-full h-full relative flex items-center justify-center">
                    <div class="font-display font-black text-[56px] leading-none text-bm-dark/[0.06] uppercase">{{ \Illuminate\Support\Str::limit($a->name,3,'') }}</div>
                    <div class="absolute inset-0 opacity-[0.04]" style="background-image: linear-gradient(black 1px, transparent 1px), linear-gradient(90deg, black 1px, transparent 1px); background-size: 40px 40px;"></div>
                  </div>
                @endif
              </div>

              <h3 class="mt-5 font-display font-black text-[26px] leading-[0.9] uppercase text-bm-dark">{{ $a->name }}</h3>
              @if($a->description)
                <p class="mt-2 text-[13px] leading-relaxed text-bm-dark/60 line-clamp-2">{{ $a->description }}</p>
              @endif

              {{-- Price block — industrial --}}
              <div class="mt-auto pt-5 flex items-end justify-between gap-3 border-t border-bm-dark/10">
                <div>
                  <div class="font-mono text-[10px] uppercase tracking-widest text-bm-dark/50">{{ $a->price_note }}</div>
                  <div class="mt-1 flex items-baseline gap-1 text-bm-dark">
                    <span class="font-mono text-[12px]">Rp</span>
                    <span class="font-display font-black text-[28px] leading-none">{{ $a->display_price }}</span>
                  </div>
                  <div class="mt-1 font-mono text-[10px] text-bm-dark/50">negotiable • tarif rute menyesuaikan</div>
                </div>
                <a href="https://wa.me/{{ $whatsapp }}?text={{ $waText }}" target="_blank" rel="noopener"
                   class="bg-bm-yellow text-bm-dark px-4 py-2.5 font-display font-bold uppercase text-[10px] leading-tight tracking-wide hover:bg-bm-yellow-dark whitespace-nowrap text-center shadow-sm"
                   title="Info Harga via WA">
                  Info Harga →
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-10 grid lg:grid-cols-[auto_1fr_auto] gap-4 items-center bg-bm-dark text-bm-cream px-5 py-4 border border-bm-dark/10">
        <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">Butuh armada khusus?</div>
        <div class="h-px lg:h-auto lg:w-px bg-bm-dark/10 lg:self-stretch"></div>
        <a href="https://wa.me/{{ $whatsapp }}?text={{ $waMessage }}" target="_blank" class="inline-flex justify-center bg-bm-red px-5 py-2.5 font-display uppercase text-[12px] font-bold hover:bg-bm-red-dark">Konsultasi via WhatsApp →</a>
      </div>

    @endif
  </div>
</section>

@push('scripts')
<script>
(() => {
  const btns = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.armada-card');
  btns.forEach(b => b.addEventListener('click', () => {
    const f = b.dataset.filter;
    btns.forEach(x => { x.classList.remove('is-active','bg-bm-dark','text-bm-cream'); x.classList.add('border-bm-dark/15'); });
    b.classList.add('is-active','bg-bm-dark','text-bm-cream');
    b.classList.remove('border-bm-dark/15');
    cards.forEach(c => {
      const show = f === 'all' || c.dataset.type === f;
      c.style.display = show ? '' : 'none';
    });
  }));
})();
</script>
@endpush

@push('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'ItemList',
  'name' => 'Daftar Armada PT Berkah Makmur Transport',
  'itemListElement' => $armadas->values()->map(fn($a,$i) => [
    '@type' => 'ListItem',
    'position' => $i+1,
    'name' => $a->name.' — Mulai Rp '.$a->display_price,
    'url' => route('armada.index').'#'. \Illuminate\Support\Str::slug($a->name),
  ])->toArray()
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush
@endsection
