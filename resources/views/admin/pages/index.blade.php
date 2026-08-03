@extends('layouts.admin')
@section('title','Konten Halaman')
@section('content')
<div class="flex items-end justify-between">
  <div>
    <div class="label-industrial">CMS</div>
    <h1 class="mt-2 font-display font-black text-[26px] uppercase">Konten Halaman</h1>
    <p class="mt-2 font-mono text-[11px] text-bm-gray-light max-w-[60ch]">Ubah wording per halaman. <code>beranda</code> = hero. <code>tentang-kami</code> = cerita, visi/misi, legalitas, armada. <code>kontak</code> = hero form.</p>
  </div>
</div>

@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif

<div class="mt-6 bg-bm-cream-soft border border-bm-dark/10">
  <div class="grid grid-cols-12 gap-2 px-4 py-2 border-b border-bm-dark/5 font-mono text-[10px] uppercase text-bm-gray-light">
    <div class="col-span-3">Slug</div>
    <div class="col-span-3">Title</div>
    <div class="col-span-4">SEO Title</div>
    <div class="col-span-2">Aksi</div>
  </div>
  @foreach($pages as $p)
    <div class="grid grid-cols-12 gap-2 px-4 py-3 border-b border-bm-dark/5 last:border-0 items-center hover:bg-bm-dark/[0.02]">
      <div class="col-span-3 font-mono text-[12px]"><span class="bg-bm-dark/10 px-2 py-0.5">{{ $p->slug }}</span></div>
      <div class="col-span-3 font-display uppercase text-[13px]">{{ $p->title }}</div>
      <div class="col-span-4 font-mono text-[11px] text-bm-gray-light truncate">{{ $p->seo_title ?? '-' }}</div>
      <div class="col-span-2"><a href="{{ route('admin.pages.edit',$p) }}" class="bg-bm-yellow text-bm-dark px-3 py-1.5 font-mono text-[11px] uppercase font-bold">Edit wording →</a></div>
    </div>
  @endforeach
</div>

<div class="mt-6 bg-bm-yellow/10 border border-bm-yellow/20 p-4 font-mono text-[11px]">
  <div class="font-bold uppercase">Alur edit</div>
  <div class="mt-2 text-bm-gray-light">Admin → Konten Halaman → pilih slug → isi field → Simpan → cek public page. Tidak perlu deploy.</div>
</div>
@endsection
