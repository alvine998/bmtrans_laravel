@extends('layouts.admin')
@section('title', $armada->exists ? 'Edit Armada' : 'Tambah Armada')
@section('content')
<h1 class="font-display font-black text-[22px] uppercase">{{ $armada->exists ? 'Edit' : 'Tambah' }} Armada</h1>
<p class="font-mono text-[11px] text-bm-gray-light mt-1">Upload foto armada wajib terlihat jelas — dipakai di Beranda + halaman Armada.</p>

@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif

<form method="POST" action="{{ $armada->exists ? route('admin.armada.update',$armada) : route('admin.armada.store') }}" enctype="multipart/form-data" class="mt-6 grid lg:grid-cols-[1.2fr_0.8fr] gap-6">
  @csrf @if($armada->exists) @method('PUT') @endif

  <div class="space-y-4 bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div>
      <label class="font-mono text-[11px] uppercase">Nama Armada *</label>
      <input name="name" value="{{ old('name',$armada->name) }}" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[14px]" placeholder="Pickup Bak">
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label class="font-mono text-[11px] uppercase">Tipe / Group (untuk filter)</label>
        <input name="type" value="{{ old('type',$armada->type) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px] font-mono" placeholder="pickup / colt_diesel / fusso / tronton">
        <div class="font-mono text-[10px] text-bm-gray-light mt-1">Saran: pickup, colt_diesel, fusso, tronton, wingbox</div>
      </div>
      <div>
        <label class="font-mono text-[11px] uppercase">Urutan</label>
        <input type="number" name="order" value="{{ old('order',$armada->order ?? 0) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2">
      </div>
    </div>

    <div class="border border-bm-yellow/20 bg-bm-yellow/5 p-4">
      <div class="font-mono text-[11px] uppercase text-bm-yellow font-bold">Harga</div>
      <div class="grid grid-cols-2 gap-3 mt-3">
        <div>
          <label class="font-mono text-[11px] uppercase">Harga Mulai (Rp angka) *</label>
          <input type="number" name="price_start" value="{{ old('price_start',$armada->price_start ?? 0) }}" required min="0" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[14px] font-mono" placeholder="200000">
          <div class="font-mono text-[10px] text-bm-gray-light mt-1">Isi angka rupiah asli ex: 200000 = 200rb, 1200000 = 1,2jt</div>
        </div>
        <div>
          <label class="font-mono text-[11px] uppercase">Label Override (opsional)</label>
          <input name="price_label" value="{{ old('price_label',$armada->price_label) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[14px] font-mono" placeholder="200rb — kosongkan = auto">
          <div class="font-mono text-[10px] text-bm-gray-light mt-1">Kosongkan untuk auto 200rb/1,2jt/1,6jt</div>
        </div>
      </div>
      <div class="mt-3">
        <label class="font-mono text-[11px] uppercase">Catatan Harga</label>
        <input name="price_note" value="{{ old('price_note',$armada->price_note ?? 'Mulai dari') }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]" placeholder="Mulai dari">
      </div>
      @if($armada->exists)
        <div class="mt-3 font-mono text-[11px]">Preview: <span class="bg-bm-yellow text-bm-dark px-2 py-1 font-bold">{{ $armada->price_note }} Rp {{ $armada->display_price }}</span></div>
      @endif
    </div>

    <div>
      <label class="font-mono text-[11px] uppercase">Deskripsi / Kapasitas</label>
      <textarea name="description" rows="3" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]" placeholder="Kapasitas 2 ton, cocok dalam kota...">{{ old('description',$armada->description) }}</textarea>
    </div>
  </div>

  <div class="space-y-4">
    <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
      <label class="flex items-center gap-2 font-mono text-[11px] uppercase"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$armada->is_active ?? true))> Aktif tampil di publik</label>

      <div class="mt-5">
        <label class="font-mono text-[11px] uppercase font-bold text-bm-yellow tracking-widest">Foto Armada</label>
        <p class="font-mono text-[10px] text-bm-gray-light mt-1">JPG/PNG/WebP max 5MB. Auto WebP 1400w. Rasio ideal 16:10 / 4:3 — hindari foto blur.</p>
        <input id="armada-image-input" type="file" name="image" accept="image/jpeg,image/png,image/webp" class="mt-2 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px] file:bg-bm-yellow file:text-bm-dark file:border-0 file:px-3 file:py-1 file:font-mono file:text-[11px] file:uppercase file:font-bold file:mr-3 file:cursor-pointer">
        <div id="armada-image-preview" class="mt-3 hidden">
          <div class="font-mono text-[10px] uppercase mb-1 text-bm-gray-light">Preview baru:</div>
          <img id="armada-preview-img" class="w-full h-[180px] object-cover border border-bm-yellow/30 bg-bm-cream">
        </div>

        @if($armada->image)
          <div class="mt-4 border border-bm-dark/10 p-2 bg-bm-cream">
            <div class="flex items-center justify-between">
              <span class="font-mono text-[10px] uppercase text-bm-gray-light">Foto tersimpan saat ini</span>
              <span class="font-mono text-[9px] px-1.5 py-0.5 bg-bm-yellow text-bm-dark">ACTIVE IMAGE</span>
            </div>
            <img src="{{ $armada->image_url }}" class="mt-2 w-full h-[160px] object-cover border border-bm-dark/10 bg-bm-cream">
            <div class="mt-2 flex items-center justify-between gap-2">
              <span class="font-mono text-[10px] truncate text-bm-gray-light" title="{{ $armada->image }}">{{ $armada->image }}</span>
              <label class="flex items-center gap-1.5 font-mono text-[10px] uppercase text-bm-red cursor-pointer shrink-0">
                <input type="checkbox" name="remove_image" value="1" class="accent-red-600"> Hapus
              </label>
            </div>
          </div>
        @endif

        <div class="mt-3 p-2.5 border border-dashed border-bm-dark/10 bg-bm-cream/50">
          <div class="font-mono text-[10px] uppercase text-bm-gray-light">Tips foto armada</div>
          <ul class="mt-1 list-disc pl-4 font-mono text-[10px] text-bm-gray-light space-y-0.5 leading-relaxed">
            <li>Foto samping 3/4, background bersih / gudang</li>
            <li>Jangan foto miring — buat card tampil rapi</li>
            <li>Jika kosong: otomatis pakai inisial + grid motif</li>
          </ul>
        </div>
      </div>

      <button type="submit" class="mt-6 w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold hover:bg-bm-red-dark transition">Simpan Armada →</button>

      <div class="mt-4 bg-bm-cream border border-bm-dark/10 p-3 font-mono text-[10px] text-bm-gray-light">
        <div class="uppercase text-bm-yellow font-bold mb-1">Info WA Nego</div>
        Tombol "Nego dengan Admin Sampai Jadi!" WA ke nomor di Pengaturan → contact.whatsapp
        <div class="mt-2 bg-bm-dark/5 p-2 text-bm-dark/70">"Halo BM Trans, saya ingin negosiasi harga {{ $armada->name ?: '[Nama Armada]' }}. Bisa dibantu?"</div>
      </div>
    </div>
  </div>
</form>

<script>
(function(){
  const input = document.getElementById('armada-image-input');
  const wrap = document.getElementById('armada-image-preview');
  const img = document.getElementById('armada-preview-img');
  if(!input||!wrap||!img) return;
  input.addEventListener('change', (e)=>{
    const f = e.target.files && e.target.files[0];
    if(!f){ wrap.classList.add('hidden'); return; }
    const url = URL.createObjectURL(f);
    img.src = url;
    wrap.classList.remove('hidden');
  });
})();
</script>
@endsection
