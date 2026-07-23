@extends('layouts.admin')
@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('content')
<h1 class="font-display font-black text-[22px] uppercase">{{ $service->exists ? 'Edit' : 'Tambah' }} Layanan</h1>

@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif

<form method="POST" action="{{ $service->exists ? route('admin.services.update',$service) : route('admin.services.store') }}" enctype="multipart/form-data" class="mt-6 grid lg:grid-cols-[1.2fr_0.8fr] gap-6" id="service-form">
  @csrf @if($service->exists) @method('PUT') @endif

  <div class="space-y-4 bg-bm-black-soft border border-white/10 p-5">
    <div>
      <label class="font-mono text-[11px] uppercase">Judul *</label>
      <input name="title" value="{{ old('title',$service->title) }}" required class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[14px]">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Slug (otomatis jika kosong)</label>
      <input name="slug" value="{{ old('slug',$service->slug) }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px] font-mono">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Excerpt 1 baris</label>
      <input name="excerpt" value="{{ old('excerpt',$service->excerpt) }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]">
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Body (HTML disanitasi via Purifier)</label>
      <textarea name="body" rows="10" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]">{{ old('body',$service->body) }}</textarea>
      <div class="mt-2 font-mono text-[10px] text-bm-gray-light">Quill.js self-hosted akan replace textarea pada form artikel; service pakai raw HTML + purify.</div>
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Features (satu per baris, akan jadi array)</label>
      @php
        $featOld = old('features_text');
        if ($featOld !== null) {
          $feat = $featOld;
        } elseif (is_array(old('features'))) {
          $feat = implode("\n", old('features'));
        } elseif ($service->features) {
          $feat = implode("\n", $service->features);
        } else {
          $feat = '';
        }
      @endphp
      <textarea name="features_text" id="features_text" rows="5" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px] font-mono" placeholder="Armada GPS real-time&#10;Asuransi all-risk">{{ $feat }}</textarea>
      <p class="mt-1 font-mono text-[10px] text-bm-gray-light">JS akan ubah jadi hidden array features[] saat submit.</p>
    </div>
  </div>

  <div class="space-y-4">
    <div class="bg-bm-black-soft border border-white/10 p-5">
      <div class="grid grid-cols-2 gap-3">
        <div><label class="font-mono text-[11px] uppercase">Order</label><input type="number" name="order" value="{{ old('order',$service->order ?? 0) }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2"></div>
        <div class="flex items-end gap-2 pb-2"><label class="flex items-center gap-2 font-mono text-[11px] uppercase"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$service->is_active ?? true))> Aktif</label></div>
      </div>
      <div class="mt-4">
        <label class="font-mono text-[11px] uppercase">Image (jpg/png/webp max 4MB, akan re-encode WebP)</label>
        <input type="file" name="image" accept="image/*" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[12px]">
        @if($service->image)<div class="mt-2 text-[11px] font-mono">Saat ini: {{ $service->image }}</div>@endif
      </div>
      <div class="mt-4">
        <label class="font-mono text-[11px] uppercase">SEO Title</label>
        <input name="seo_title" value="{{ old('seo_title',$service->seo_title) }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]">
      </div>
      <div class="mt-2">
        <label class="font-mono text-[11px] uppercase">SEO Description</label>
        <textarea name="seo_description" rows="3" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[12px]">{{ old('seo_description',$service->seo_description) }}</textarea>
      </div>
      <button type="submit" class="mt-6 w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold">Simpan Layanan →</button>
    </div>
  </div>
</form>

<script>
document.getElementById('service-form').addEventListener('submit', function(e){
  const ta = document.getElementById('features_text');
  if (!ta) return;
  const lines = ta.value.split('\n').map(s=>s.trim()).filter(Boolean);
  // remove old injected if any
  this.querySelectorAll('input[name^=\"features[\"]').forEach(el=>el.remove());
  lines.forEach((line,i)=>{
    const inp = document.createElement('input');
    inp.type='hidden'; inp.name='features['+i+']'; inp.value=line;
    this.appendChild(inp);
  });
  // prevent original textarea from sending as features_text only (server ignores it)
});
</script>
@endsection
