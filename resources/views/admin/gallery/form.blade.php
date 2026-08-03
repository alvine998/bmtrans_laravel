@extends('layouts.admin')
@section('title','Upload Galeri')
@section('content')
<h1 class="font-display font-black text-[20px] uppercase">Upload Galeri</h1>
<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="mt-6 bg-bm-cream-soft border border-bm-dark/10 p-5 space-y-4 max-w-[560px]">
  @csrf
  <div><label class="font-mono text-[11px] uppercase">Judul</label><input name="title" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"></div>
  <div class="grid grid-cols-2 gap-3">
    <div><label class="font-mono text-[11px] uppercase">Tipe</label><select name="type" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"><option value="image">Image (WebP re-encode)</option><option value="video">Video (mp4 max 20MB)</option></select></div>
    <div><label class="font-mono text-[11px] uppercase">Kategori</label><select name="category" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"><option value="fleet">Armada</option><option value="warehouse">Gudang</option><option value="operations">Operasional</option></select></div>
  </div>
  <div><label class="font-mono text-[11px] uppercase">File * (image akan jadi WebP, hapus metadata)</label><input type="file" name="file" required accept="image/*,video/*" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px]"></div>
  <div><label class="font-mono text-[11px] uppercase">Alt Text (SEO + aksesibilitas, wajib)</label><input name="alt_text" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]" placeholder="Truk Fuso muat pallet di pelabuhan Panjang"></div>
  <div><label class="font-mono text-[11px] uppercase">Caption</label><input name="caption" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"></div>
  <button class="w-full bg-bm-red py-3 font-display uppercase text-[12px] font-bold">Upload →</button>
</form>
@endsection
