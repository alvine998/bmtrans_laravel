@extends('layouts.admin')
@section('title', $partner->exists ? 'Edit Partner' : 'Tambah Partner')
@section('content')
<h1 class="font-display font-black text-[22px] uppercase">{{ $partner->exists ? 'Edit' : 'Tambah' }} Partner</h1>

@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif

<form method="POST" action="{{ $partner->exists ? route('admin.partners.update',$partner) : route('admin.partners.store') }}" enctype="multipart/form-data" class="mt-6 grid lg:grid-cols-[1.2fr_0.8fr] gap-6">
  @csrf @if($partner->exists) @method('PUT') @endif

  <div class="space-y-4 bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div>
      <label class="font-mono text-[11px] uppercase">Nama Partner *</label>
      <input name="name" value="{{ old('name',$partner->name) }}" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[14px]">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Slug (otomatis jika kosong)</label>
      <input name="slug" value="{{ old('slug',$partner->slug) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px] font-mono">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">URL (tautan ke website partner)</label>
      <input name="url" value="{{ old('url',$partner->url) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]" placeholder="https://">
    </div>
  </div>

  <div class="space-y-4">
    <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
      <div class="grid grid-cols-2 gap-3">
        <div><label class="font-mono text-[11px] uppercase">Order</label><input type="number" name="order" value="{{ old('order',$partner->order ?? 0) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2"></div>
        <div class="flex items-end gap-2 pb-2"><label class="flex items-center gap-2 font-mono text-[11px] uppercase"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$partner->is_active ?? true))> Aktif</label></div>
      </div>
      <div class="mt-4">
        <label class="font-mono text-[11px] uppercase">Logo (jpg/png/webp max 4MB)</label>
        <input type="file" name="logo" accept="image/*" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px]">
        @if($partner->logo)<div class="mt-2"><img src="{{ asset('storage/'.$partner->logo) }}" alt="" class="h-12 border border-bm-dark/10"><div class="mt-1 font-mono text-[10px] text-bm-gray-light">{{ $partner->logo }}</div></div>@endif
      </div>
      <button type="submit" class="mt-6 w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold">Simpan Partner →</button>
    </div>
  </div>
</form>
@endsection
