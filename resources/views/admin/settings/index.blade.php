@extends('layouts.admin')
@section('title','Pengaturan')
@section('content')
@php $canEdit = auth('admin')->user()?->isSuperAdmin(); @endphp
<h1 class="font-display font-black text-[22px] uppercase">Pengaturan Situs — Key/Value Store</h1>
@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif
@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif
@unless($canEdit)
  <div class="mt-4 border border-bm-yellow/30 bg-bm-yellow/5 p-3 font-mono text-[12px] text-bm-yellow">Read-only. Hanya super_admin bisa ubah pengaturan.</div>
@endunless

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6 max-w-[720px]" @unless($canEdit) onsubmit="return false" @endunless>
  @csrf

  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">Logo Perusahaan</div>
    <p class="mt-1 text-[11px] text-bm-gray-light">Dipakai di navbar, footer, dan Tentang Kami. PNG/JPG/WEBP, max 2MB. Kosongkan jika ingin pakai logo teks default (BM).</p>
    <div class="mt-4 flex items-center gap-4">
      <div class="w-20 h-20 bg-bm-cream border border-bm-dark/10 flex items-center justify-center overflow-hidden shrink-0">
        @if($logo)
          <img src="{{ asset('storage/'.$logo) }}" alt="Logo saat ini" class="w-full h-full object-contain">
        @else
          <span class="font-display font-black text-2xl text-bm-red">BM</span>
        @endif
      </div>
        <input type="file" name="logo" accept="image/png,image/jpeg,image/webp" @disabled(! $canEdit) class="flex-1 text-[12px] font-mono file:mr-3 file:bg-bm-red file:text-white file:border-0 file:px-3 file:py-2 file:uppercase file:font-bold file:text-[11px] bg-bm-cream border border-bm-dark/10 px-3 py-2 disabled:opacity-50">
    </div>
  </div>

  @foreach($settings as $group => $items)
    @continue($items->every(fn($s) => $s->key === 'branding.logo'))
    <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
      <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">{{ $group }}</div>
      <div class="mt-4 space-y-4">
        @foreach($items as $s)
          @continue($s->key === 'branding.logo')
          @php
            // Bugfix: use encoded key for form name to preserve dots. Use base64-like substitute: __DOT__
            $formKey = str_replace('.', '__DOT__', $s->key);
          @endphp
          <div>
            <label class="font-mono text-[10px] uppercase tracking-[0.15em] text-bm-gray-light">{{ $s->key }}</label>
            <div class="mt-1 flex gap-2">
              <input type="hidden" name="keys[{{ $formKey }}]" value="{{ $s->key }}">
              @if(str_contains($s->key,'address') || str_contains($s->key,'description'))
                <textarea name="settings_data[{{ $formKey }}]" rows="2" @readonly(! $canEdit) class="w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px] font-mono">{{ old('settings_data.'.$formKey, $s->value) }}</textarea>
              @else
                <input type="text" name="settings_data[{{ $formKey }}]" value="{{ old('settings_data.'.$formKey, $s->value) }}" @readonly(! $canEdit) class="w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px] font-mono">
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach

  @if($canEdit)
  <div class="bg-bm-yellow/10 border border-bm-yellow/20 p-4">
    <div class="font-mono text-[11px] uppercase font-bold">Tambah setting baru</div>
    <p class="mt-1 text-[11px] text-bm-gray-light">Format key: <code>contact.phone</code>, <code>seo.home_title</code>. Disimpan via SiteSetting::setValue, cache 1 jam.</p>
    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
      <div>
        <label class="font-mono text-[10px] uppercase">Key baru</label>
        <input name="new_key" placeholder="ex: contact.address" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px] font-mono">
      </div>
      <div>
        <label class="font-mono text-[10px] uppercase">Value baru</label>
        <input name="new_value" placeholder="Jl. Contoh No 123" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px]">
      </div>
    </div>
  </div>

  <div class="flex items-center gap-4">
    <button class="bg-bm-red px-6 py-3 font-display uppercase text-[13px] font-bold">Simpan Semua →</button>
    <span class="font-mono text-[11px] text-bm-gray-light">Hanya super_admin dapat simpan (role middleware).</span>
  </div>
  @endif
</form>
@endsection
