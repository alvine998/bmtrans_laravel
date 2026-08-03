<div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Hero — Hubungi Kami</div>
  <p class="mt-1 font-mono text-[10px] text-bm-gray-light">Nomor WA / alamat / email di <strong>Pengaturan</strong>. Di sini hanya wording hero.</p>
  <div class="mt-4 space-y-3">
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['hero_kicker'] }}</label>
      <input name="sections[hero_kicker]" value="{{ old('sections.hero_kicker', $s['hero_kicker'] ?? 'Hubungi Kami') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['hero_title'] }}</label>
      <input name="sections[hero_title]" value="{{ old('sections.hero_title', $s['hero_title'] ?? 'Siap angkut. Siap jawab.') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[14px]">
    </div>
    <div>
      <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['intro'] }}</label>
      <textarea name="sections[intro]" rows="3" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">{{ old('sections.intro', $s['intro'] ?? 'Isi form atau chat WA. Estimasi tarif 2 jam kerja untuk rute reguler.') }}</textarea>
    </div>
  </div>
</div>
