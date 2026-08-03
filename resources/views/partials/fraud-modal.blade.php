{{-- Modal peringatan penipuan — tampil setiap refresh halaman --}}
<div id="fraud-modal" class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="fraud-title">
  <div id="fraud-backdrop" class="absolute inset-0 bg-bm-dark/75 backdrop-blur-sm"></div>

  <div class="fraud-box relative w-full max-w-[520px] bg-bm-cream-light shadow-[0_32px_80px_rgba(0,0,0,0.55)] overflow-hidden">
    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-bm-red"></div>
    <div class="hazard-stripe"></div>

    <div class="flex flex-col p-6 sm:p-8">
      <div class="flex items-center gap-3">
        <span class="w-2.5 h-2.5 bg-bm-red rounded-full animate-pulse"></span>
        <span class="font-mono text-[11px] uppercase tracking-[0.25em] font-bold text-bm-red">Peringatan Keamanan</span>
      </div>

      <h2 id="fraud-title" class="mt-4 font-display font-black text-[30px] sm:text-[36px] uppercase leading-[0.9]">
        Waspada modus<br><span class="text-bm-red">penipuan</span><br>atas nama kami
      </h2>

      <div class="mt-7 space-y-5 text-[14px] leading-relaxed text-bm-dark/85">
        <div class="flex gap-4">
          <span class="w-6 h-6 shrink-0 bg-bm-red text-bm-cream font-display font-bold text-[12px] flex items-center justify-center">01</span>
          <p>Kami <strong>tidak pernah</strong> meminta pembayaran ke rekening pribadi, nomor pribadi, atau aplikasi pembayaran tidak resmi.</p>
        </div>
        <div class="flex gap-4">
          <span class="w-6 h-6 shrink-0 bg-bm-red text-bm-cream font-display font-bold text-[12px] flex items-center justify-center">02</span>
          <p>Penawaran harga <strong>tidak wajar</strong> atau permintaan uang muka di luar prosedur patut dicurigai.</p>
        </div>
        <div class="flex gap-4">
          <span class="w-6 h-6 shrink-0 bg-bm-red text-bm-cream font-display font-bold text-[12px] flex items-center justify-center">03</span>
          <p>Selalu verifikasi melalui <strong>kontak resmi</strong> kami sebelum transfer atau mengirim barang.</p>
        </div>
      </div>

      <div class="mt-7 bg-bm-yellow/20 border-l-4 border-bm-yellow p-4">
        <div class="font-mono text-[10px] uppercase tracking-widest font-bold text-bm-dark/60">Hubungi hanya melalui kanal resmi</div>
        <div class="mt-2 space-y-1 font-mono text-[12px] text-bm-dark">
          <div>WA: {{ \App\Models\SiteSetting::getValue('contact.whatsapp', '6281271234567') }}</div>
          <div>Telp: {{ \App\Models\SiteSetting::getValue('contact.phone', '+62 711-123-456') }}</div>
          <div>{{ \App\Models\SiteSetting::getValue('contact.email', 'info@berkahmakmurtransport.co.id') }}</div>
        </div>
      </div>

      <button id="fraud-close" class="mt-6 w-full bg-bm-red text-white px-6 py-4 font-display font-bold uppercase text-[13px] tracking-wide hover:bg-bm-red-dark transition clip-notch flex items-center justify-center gap-3">
        Saya Mengerti <span aria-hidden="true">→</span>
      </button>
    </div>

    <button id="fraud-close-x" aria-label="Tutup" class="absolute top-3 right-3 w-10 h-10 flex items-center justify-center bg-bm-dark text-bm-cream hover:bg-bm-red transition-colors">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 6l12 12M18 6L6 18" stroke-width="2" stroke-linecap="round"/></svg>
    </button>
  </div>
</div>

<style>
  #fraud-modal #fraud-backdrop { opacity: 0; transition: opacity .3s ease; }
  #fraud-modal .fraud-box { transform: scale(.94) translateY(16px); opacity: 0; transition: transform .4s cubic-bezier(.22,1,.36,1), opacity .35s ease; }
  #fraud-modal.fraud-open #fraud-backdrop { opacity: 1; }
  #fraud-modal.fraud-open .fraud-box { transform: scale(1) translateY(0); opacity: 1; }
</style>
