<div class="bg-bm-black-soft border border-white/10 p-5">
  <div class="font-mono text-[11px] uppercase tracking-widest">Hero — wording utama Beranda</div>
  <p class="mt-1 font-mono text-[10px] text-bm-gray-light">Kosongkan = pakai fallback default. Judul 4 baris dipecah agar bisa style warna berbeda (baris 2 kuning, baris 4 merah).</p>

  <div class="mt-4 space-y-4">
    <div class="bg-bm-black border border-white/5 p-4 space-y-3">
      <div class="font-mono text-[10px] uppercase font-bold text-bm-yellow">Kicker + Headline</div>
      <div>
        <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['hero_kicker'] ?? 'hero_kicker' }}</label>
        <input name="sections[hero_kicker]" value="{{ old('sections.hero_kicker', $s['hero_kicker'] ?? 'Sejak 2010 — Palembang • Jakarta • Surabaya') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[13px]">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div><label class="font-mono text-[10px] uppercase text-bm-gray-light">Baris 1 — Logistik</label><input name="sections[hero_title_1]" value="{{ old('sections.hero_title_1', $s['hero_title_1'] ?? 'Logistik') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2"></div>
        <div><label class="font-mono text-[10px] uppercase text-bm-yellow">Baris 2 kuning — tidak boleh</label><input name="sections[hero_title_2]" value="{{ old('sections.hero_title_2', $s['hero_title_2'] ?? 'tidak boleh') }}" class="mt-1 w-full bg-bm-black-soft border border-bm-yellow/30 px-3 py-2"></div>
        <div><label class="font-mono text-[10px] uppercase text-bm-gray-light">Baris 3 — bermain-</label><input name="sections[hero_title_3]" value="{{ old('sections.hero_title_3', $s['hero_title_3'] ?? 'bermain-') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2"></div>
        <div><label class="font-mono text-[10px] uppercase text-bm-red">Baris 4 merah — main.</label><input name="sections[hero_title_4]" value="{{ old('sections.hero_title_4', $s['hero_title_4'] ?? 'main.') }}" class="mt-1 w-full bg-bm-black-soft border border-bm-red/30 px-3 py-2"></div>
      </div>
      <div>
        <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $editable['hero_subtitle'] }}</label>
        <textarea name="sections[hero_subtitle]" rows="3" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[13px]">{{ old('sections.hero_subtitle', $s['hero_subtitle'] ?? 'Kami mengangkut muatan industri berat, kontainer 40ft, dan distribusi FMCG dengan 120+ armada GPS, asuransi all-risk, dan SOP muat-bongkar yang disiplin.') }}</textarea>
      </div>
    </div>

    <div class="bg-bm-black border border-white/5 p-4 grid sm:grid-cols-2 gap-3">
      <div><label class="font-mono text-[10px] uppercase">CTA primary</label><input name="sections[hero_cta_primary]" value="{{ old('sections.hero_cta_primary', $s['hero_cta_primary'] ?? 'Dapat Penawaran 2 Jam') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[13px]"></div>
      <div><label class="font-mono text-[10px] uppercase">CTA secondary</label><input name="sections[hero_cta_secondary]" value="{{ old('sections.hero_cta_secondary', $s['hero_cta_secondary'] ?? 'Lihat Armada') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[13px]"></div>
      <div><label class="font-mono text-[10px] uppercase">Badge 1</label><input name="sections[hero_badge_1]" value="{{ old('sections.hero_badge_1', $s['hero_badge_1'] ?? '12.847 pengiriman selesai') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[12px]"></div>
      <div><label class="font-mono text-[10px] uppercase">Badge 2</label><input name="sections[hero_badge_2]" value="{{ old('sections.hero_badge_2', $s['hero_badge_2'] ?? 'ISO 9001:2015') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[12px]"></div>
      <div><label class="font-mono text-[10px] uppercase">Badge 3</label><input name="sections[hero_badge_3]" value="{{ old('sections.hero_badge_3', $s['hero_badge_3'] ?? 'Asuransi ACA') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 text-[12px]"></div>
    </div>

    <div class="bg-bm-black border border-white/5 p-4 grid sm:grid-cols-2 gap-3">
      <div><label class="font-mono text-[10px] uppercase">Manifest ID</label><input name="sections[hero_manifest_id]" value="{{ old('sections.hero_manifest_id', $s['hero_manifest_id'] ?? 'BMT-2026-1847') }}" class="mt-1 w-full bg-bm-black-soft border border-white/10 px-3 py-2 font-mono text-[12px]"></div>
      <div><label class="font-mono text-[10px] uppercase">Manifest note kuning</label><input name="sections[hero_manifest_note]" value="{{ old('sections.hero_manifest_note', $s['hero_manifest_note'] ?? 'SOP bongkar wajib foto 4 sisi + video segel. Tidak ada kompromi.') }}" class="mt-1 w-full bg-bm-black-soft border border-bm-yellow/20 px-3 py-2 text-[12px]"></div>
    </div>
  </div>
</div>
