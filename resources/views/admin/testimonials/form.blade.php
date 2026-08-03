@extends('layouts.admin')
@section('title', $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('content')
<h1 class="font-display font-black text-[22px] uppercase">{{ $testimonial->exists ? 'Edit' : 'Tambah' }} Testimoni</h1>

@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif

<form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update',$testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data" class="mt-6 grid lg:grid-cols-[1.2fr_0.8fr] gap-6">
  @csrf @if($testimonial->exists) @method('PUT') @endif

  <div class="space-y-4 bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div>
      <label class="font-mono text-[11px] uppercase">Nama Klien *</label>
      <input name="name" value="{{ old('name',$testimonial->name) }}" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[14px]">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Perusahaan</label>
      <input name="company" value="{{ old('company',$testimonial->company) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]" placeholder="PT Contoh Abadi">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Kutipan / Testimoni *</label>
      <textarea name="quote" rows="4" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]" placeholder="Pelayanan BMT sangat memuaskan...">{{ old('quote',$testimonial->quote) }}</textarea>
    </div>
  </div>

  <div class="space-y-4">
    <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="font-mono text-[11px] uppercase">Rating (1-5)</label>
          <select name="rating" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">
            @for($i=5;$i>=1;$i--)
              <option value="{{ $i }}" @selected(old('rating',$testimonial->rating ?? 5)==$i)>{{ str_repeat('★',$i) }}{{ str_repeat('☆',5-$i) }} ({{ $i }})</option>
            @endfor
          </select>
        </div>
        <div>
          <label class="font-mono text-[11px] uppercase">Order</label>
          <input type="number" name="order" value="{{ old('order',$testimonial->order ?? 0) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2">
        </div>
      </div>
      <div class="mt-3 flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active',$testimonial->is_active ?? true))>
        <label for="is_active" class="font-mono text-[11px] uppercase">Aktif</label>
      </div>
      <div class="mt-4">
        <label class="font-mono text-[11px] uppercase">Foto Klien (jpg/png/webp max 2MB)</label>
        <input type="file" name="photo" accept="image/*" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px]">
        @if($testimonial->photo)<div class="mt-2"><img src="{{ asset('storage/'.$testimonial->photo) }}" alt="" class="h-12 w-12 rounded-full object-cover border border-bm-dark/10"><div class="mt-1 font-mono text-[10px] text-bm-gray-light">{{ $testimonial->photo }}</div></div>@endif
      </div>
      <button type="submit" class="mt-6 w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold">Simpan Testimoni →</button>
    </div>
  </div>
</form>
@endsection
