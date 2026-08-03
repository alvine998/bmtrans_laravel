<div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Hero — Tentang Kami</div>
  <p class="mt-1 font-mono text-[10px] text-bm-gray-light">Judul 2 baris. Baris 2 kuning. Kosongkan = fallback default di frontend.</p>

  <div class="mt-4 space-y-3">
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['hero_kicker'] }}</label>
      <input name="sections[hero_kicker]" value="{{ old('sections.hero_kicker', $s['hero_kicker'] ?? 'Tentang Kami') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
    </div>
    <div class="grid sm:grid-cols-2 gap-3">
      <div>
        <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['hero_title_1'] }}</label>
        <input name="sections[hero_title_1]" value="{{ old('sections.hero_title_1', $s['hero_title_1'] ?? 'Bukan sekadar') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2">
      </div>
      <div>
        <label class="font-mono text-[10px] uppercase text-bm-yellow">{{ $editable['hero_title_2'] }}</label>
        <input name="sections[hero_title_2]" value="{{ old('sections.hero_title_2', $s['hero_title_2'] ?? 'angkut-angkut.') }}" class="mt-1 w-full bg-bm-cream border border-bm-yellow/30 px-3 py-2">
      </div>
    </div>
  </div>
</div>

<div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Cerita perusahaan</div>
  <div class="mt-4 space-y-3">
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['intro_1'] }}</label>
      <textarea name="sections[intro_1]" rows="3" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">{{ old('sections.intro_1', $s['intro_1'] ?? 'PT Berkah Makmur Transport berdiri 2017 di Palembang. Awalnya hanya 3 truk CDD untuk angkutan pupuk, kini mencakup jalur darat Sumatera–Jawa–Bali, sea freight LCL via Tanjung Priok–Panjang–Belawan, dan gudang 5.000m².') }}</textarea>
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['intro_2'] }}</label>
      <textarea name="sections[intro_2]" rows="3" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">{{ old('sections.intro_2', $s['intro_2'] ?? 'Kami menolak overloading di atas toleransi, menolak jalan tikus tanpa izin, menolak bongkar tanpa dokumentasi. Mahal sedikit di depan, tapi murah di klaim belakang.') }}</textarea>
    </div>
  </div>
</div>

<div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Visi & Misi</div>
  <div class="mt-4 space-y-3">
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['visi'] }}</label>
      <textarea name="sections[visi]" rows="2" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">{{ old('sections.visi', $s['visi'] ?? 'Menjadi logistik industri paling dapat diandalkan di koridor barat Indonesia.') }}</textarea>
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['misi'] }}</label>
      <textarea name="sections[misi]" rows="2" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">{{ old('sections.misi', $s['misi'] ?? 'Disiplin SOP, transparan tracking, driver sejahtera, kargo selamat.') }}</textarea>
    </div>
  </div>
</div>

<div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Legalitas</div>
  <div class="mt-4 grid sm:grid-cols-2 gap-3">
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['legal_siup'] }}</label>
      <input name="sections[legal_siup]" value="{{ old('sections.legal_siup', $s['legal_siup'] ?? 'SIUP: 503/XXX/2012') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 font-mono text-[12px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['legal_npwp'] }}</label>
      <input name="sections[legal_npwp]" value="{{ old('sections.legal_npwp', $s['legal_npwp'] ?? 'NPWP: 00.000.000.0-000.000') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 font-mono text-[12px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['legal_tdp'] }}</label>
      <input name="sections[legal_tdp]" value="{{ old('sections.legal_tdp', $s['legal_tdp'] ?? 'TDP: 06033520xxxx') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 font-mono text-[12px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-yellow">{{ $editable['legal_iso'] }}</label>
      <input name="sections[legal_iso]" value="{{ old('sections.legal_iso', $s['legal_iso'] ?? 'ISO 9001:2015') }}" class="mt-1 w-full bg-bm-cream border border-bm-yellow/30 px-3 py-2 font-mono text-[12px]">
    </div>
  </div>
</div>

<div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Ringkasan Armada</div>
  <p class="mt-1 font-mono text-[10px] text-bm-gray-light">Angka di kartu samping halaman Tentang. Detail armada tetap di menu Armada CMS.</p>
  <div class="mt-4 grid sm:grid-cols-2 gap-3">
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">CDD</label>
      <input name="sections[fleet_cdd]" value="{{ old('sections.fleet_cdd', $s['fleet_cdd'] ?? '42 unit') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">Fuso</label>
      <input name="sections[fleet_fuso]" value="{{ old('sections.fleet_fuso', $s['fleet_fuso'] ?? '38 unit') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">Tronton</label>
      <input name="sections[fleet_tronton]" value="{{ old('sections.fleet_tronton', $s['fleet_tronton'] ?? '28 unit') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">Trailer 40ft</label>
      <input name="sections[fleet_trailer]" value="{{ old('sections.fleet_trailer', $s['fleet_trailer'] ?? '19 unit') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
    </div>
  </div>
</div>
