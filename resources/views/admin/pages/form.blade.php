@extends('layouts.admin')
@section('title','Edit Halaman: '.$page->title)
@section('content')
@php $s = $page->sections ?? []; @endphp
<div class="flex items-start justify-between gap-4">
  <div>
    <a href="{{ route('admin.pages.index') }}" class="font-mono text-[11px] uppercase text-bm-gray-light hover:text-white">← Kembali ke Konten Halaman</a>
    <h1 class="mt-2 font-display font-black text-[22px] uppercase">Edit: {{ $page->title }} <span class="font-mono text-[11px] normal-case text-bm-yellow">/{{ $page->slug }}</span></h1>
  </div>
</div>

@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif
@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-200">{{ session('success') }}</div>@endif

<form method="POST" action="{{ route('admin.pages.update',$page) }}" class="mt-6 grid lg:grid-cols-[1.3fr_0.7fr] gap-6" id="page-form">
  @csrf @method('PUT')

  <div class="space-y-5">
    <div class="bg-bm-black-soft border border-white/10 p-5">
      <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">Identitas Halaman</div>
      <div class="mt-4 grid sm:grid-cols-2 gap-4">
        <div>
          <label class="font-mono text-[11px] uppercase">Title *</label>
          <input name="title" value="{{ old('title',$page->title) }}" required class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[14px]">
        </div>
        <div>
          <label class="font-mono text-[11px] uppercase">Slug (jangan ganti sembarang)</label>
          <input name="slug" value="{{ old('slug',$page->slug) }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px] font-mono">
        </div>
      </div>
    </div>

    @if($page->slug === 'beranda')
      @include('admin.pages.partials.beranda-sections', ['s' => $s, 'editable' => $editable])
    @elseif($page->slug === 'tentang-kami')
      @include('admin.pages.partials.tentang-kami-sections', ['s' => $s, 'editable' => $editable])
    @elseif($page->slug === 'kontak')
      @include('admin.pages.partials.kontak-sections', ['s' => $s, 'editable' => $editable])
    @elseif(count($editable))
      <div class="bg-bm-black-soft border border-white/10 p-5 space-y-3">
        <div class="font-mono text-[11px] uppercase tracking-widest">Sections</div>
        @foreach($editable as $key => $label)
          <div>
            <label class="font-mono text-[10px] uppercase text-bm-gray-light">{{ $label }}</label>
            <input name="sections[{{ $key }}]" value="{{ old('sections.'.$key, $s[$key] ?? '') }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]">
          </div>
        @endforeach
      </div>
    @else
      <div class="bg-bm-black-soft border border-white/10 p-5 font-mono text-[12px] text-bm-gray-light">
        Halaman ini belum punya field section khusus. Edit SEO di panel kanan.
      </div>
    @endif
  </div>

  <div class="space-y-4">
    <div class="bg-bm-black-soft border border-white/10 p-5">
      <div class="font-mono text-[11px] uppercase tracking-widest text-bm-yellow">SEO</div>
      <div class="mt-4 space-y-3">
        <div><label class="font-mono text-[10px] uppercase">SEO Title</label><input name="seo_title" value="{{ old('seo_title',$page->seo_title) }}" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]"></div>
        <div><label class="font-mono text-[10px] uppercase">SEO Description</label><textarea name="seo_description" rows="4" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[12px]">{{ old('seo_description',$page->seo_description) }}</textarea></div>
      </div>
      <button class="mt-6 w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold">Simpan wording →</button>
      <div class="mt-3 font-mono text-[10px] text-bm-gray-light">Disimpan ke <code>pages.sections</code> JSON. Frontend baca via slug <code>{{ $page->slug }}</code>.</div>
    </div>

    @if($page->slug === 'beranda')
    <div class="bg-bm-yellow text-bm-black p-4">
      <div class="font-display font-black uppercase text-[14px]">Preview Hero Title</div>
      <div id="preview-hero" class="mt-2 font-display font-black uppercase text-[20px] leading-[0.9]"></div>
      <div class="mt-2 font-mono text-[11px]" id="preview-sub"></div>
    </div>
    @elseif($page->slug === 'tentang-kami')
    <div class="bg-bm-yellow text-bm-black p-4">
      <div class="font-display font-black uppercase text-[14px]">Preview Judul</div>
      <div id="preview-about" class="mt-2 font-display font-black uppercase text-[20px] leading-[0.9]"></div>
    </div>
    @endif
  </div>
</form>

@if($page->slug === 'beranda')
<script>
const ids = ['hero_title_1','hero_title_2','hero_title_3','hero_title_4','hero_subtitle'];
function refreshPreview(){
  const v = k => document.querySelector(`[name="sections[${k}]"]`)?.value || '';
  const t1=v('hero_title_1')||'Logistik'; const t2=v('hero_title_2')||'tidak boleh';
  const t3=v('hero_title_3')||'bermain-'; const t4=v('hero_title_4')||'main.';
  const sub=v('hero_subtitle');
  document.getElementById('preview-hero').innerHTML = `${t1} <span style="color:#C79A1E">${t2}</span> ${t3} <span style="background:#D62828;color:white;padding:2px 6px;display:inline-block;transform:rotate(-1deg)">${t4}</span>`;
  document.getElementById('preview-sub').textContent = sub;
}
ids.forEach(k=>{ const el=document.querySelector(`[name="sections[${k}]"]`); if(el) el.addEventListener('input', refreshPreview); });
refreshPreview();
</script>
@elseif($page->slug === 'tentang-kami')
<script>
function refreshAboutPreview(){
  const v = k => document.querySelector(`[name="sections[${k}]"]`)?.value || '';
  const t1=v('hero_title_1')||'Bukan sekadar';
  const t2=v('hero_title_2')||'angkut-angkut.';
  document.getElementById('preview-about').innerHTML = `${t1}<br><span style="color:#C79A1E">${t2}</span>`;
}
['hero_title_1','hero_title_2'].forEach(k=>{
  const el=document.querySelector(`[name="sections[${k}]"]`);
  if(el) el.addEventListener('input', refreshAboutPreview);
});
refreshAboutPreview();
</script>
@endif
@endsection
