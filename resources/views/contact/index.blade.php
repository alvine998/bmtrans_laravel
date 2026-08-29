@extends('layouts.app')
@section('content')
<section class="bg-bm-cream text-bm-dark">
  <div class="hazard-stripe"></div>
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
    <div class="grid lg:grid-cols-[1fr_1.1fr] gap-12">

      <div>
        <div class="font-mono text-[11px] uppercase tracking-widest text-bm-red font-bold">Hubungi Kami</div>
        <h1 class="mt-3 font-display font-black text-[44px] sm:text-[60px] leading-[0.85] uppercase">Butuh bantuan<br>logistik?</h1>
        <p class="mt-4 max-w-[48ch] text-[15px] leading-relaxed opacity-70">Isi form di samping atau hubungi tim kami. Kami siap bantu jawab pertanyaan Anda dan memberikan penawaran terbaik.</p>

        <div class="mt-8 space-y-4">
          <div class="border border-bm-dark/10 p-5">
            <div class="font-mono text-[11px] uppercase">Kantor Pusat — Palembang</div>
            <div class="mt-1 font-display text-[16px] leading-tight uppercase">Jl. Lintas Timur KM 12, Kec. Alang-Alang Lebar, Palembang 30151</div>
            <div class="mt-2 font-mono text-[12px]">WA: {{ \App\Models\SiteSetting::getValue('contact.whatsapp','6285220868477') }} • Telp: {{ \App\Models\SiteSetting::getValue('contact.phone') }}</div>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div class="border border-bm-dark/10 p-4"><div class="font-mono text-[10px] uppercase">Jakarta</div><div class="font-display text-[14px] uppercase mt-1">Cakung, Jaktim — Transit hub</div></div>
            <div class="border border-bm-dark/10 p-4"><div class="font-mono text-[10px] uppercase">Surabaya</div><div class="font-display text-[14px] uppercase mt-1">Margomulyo — Gudang 2.000m²</div></div>
          </div>
          <div class="border border-bm-red/30 bg-bm-yellow/20 p-5">
            <div class="font-mono text-[11px] uppercase font-bold text-bm-red">Termin Pembayaran</div>
            <div class="mt-1 font-display text-[16px] uppercase leading-tight">Maksimal {{ \App\Models\SiteSetting::getValue('payment.term', '14 hari') }}</div>
          </div>
        </div>
      </div>

      <div class="bg-bm-cream-soft border border-bm-dark/10 text-bm-dark p-6 sm:p-8">
        <div class="label-industrial">Kirim Pesan</div>

        @if(session('success'))
          <div class="mt-4 bg-green-500/10 border border-green-500/30 p-3 text-[14px] text-green-800">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[13px] text-red-800">
            @foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach
          </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="mt-6 space-y-4">
          @csrf
          {{-- honeypot --}}
          <input type="text" name="website_url" class="hidden" tabindex="-1" autocomplete="off">

          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="font-mono text-[11px] uppercase">Nama *</label>
              <input name="name" value="{{ old('name') }}" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2.5 text-[14px] focus:border-bm-yellow outline-none" placeholder="Nama penanggung jawab">
            </div>
            <div>
              <label class="font-mono text-[11px] uppercase">Perusahaan</label>
              <input name="subject" value="{{ old('subject') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2.5 text-[14px]" placeholder="PT / CV">
            </div>
          </div>

          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="font-mono text-[11px] uppercase">Email *</label>
              <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2.5 text-[14px]" placeholder="email@perusahaan.com">
            </div>
            <div>
              <label class="font-mono text-[11px] uppercase">No WA / HP</label>
              <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2.5 text-[14px]" placeholder="+62...">
            </div>
          </div>

          <div>
            <label class="font-mono text-[11px] uppercase">Pesan *</label>
            <textarea name="message" rows="6" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2.5 text-[14px]" placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
          </div>

          <button type="submit" class="w-full bg-bm-red px-6 py-3.5 font-display font-bold uppercase text-[13px] tracking-wide hover:bg-bm-red-dark">Kirim Pesan →</button>
          <div class="font-mono text-[10px] text-bm-gray-light">Kami akan merespon pesan Anda secepatnya. Data Anda aman.</div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
