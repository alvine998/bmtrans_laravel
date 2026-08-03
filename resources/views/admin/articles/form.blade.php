@extends('layouts.admin')
@section('title',$article->exists ? 'Edit Artikel' : 'Tambah Artikel')
@section('content')
<link rel="stylesheet" href="/vendor/quill/quill.snow.css">
<h1 class="font-display font-black text-[20px] uppercase">{{ $article->exists ? 'Edit' : 'Tambah' }} Artikel</h1>

@if($errors->any())<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>@endif

<form method="POST" action="{{ $article->exists ? route('admin.articles.update',$article) : route('admin.articles.store') }}" enctype="multipart/form-data" class="mt-6 grid lg:grid-cols-[1.2fr_0.8fr] gap-6" id="article-form">
  @csrf @if($article->exists) @method('PUT') @endif
  <div class="space-y-4 bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div><label class="font-mono text-[11px] uppercase">Judul *</label><input name="title" value="{{ old('title',$article->title) }}" required class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2"></div>
    <div><label class="font-mono text-[11px] uppercase">Slug</label><input name="slug" value="{{ old('slug',$article->slug) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 font-mono text-[12px]"></div>
    <div class="grid grid-cols-2 gap-3">
      <div><label class="font-mono text-[11px] uppercase">Kategori</label><select name="category_id" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"><option value="">—</option>@foreach($categories as $c)<option value="{{ $c->id }}" @selected(old('category_id',$article->category_id)==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
      <div><label class="font-mono text-[11px] uppercase">Status *</label><select name="status" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"><option value="draft" @selected(old('status',$article->status ?? 'draft')==='draft')>Draft</option><option value="published" @selected(old('status',$article->status)==='published')>Published</option></select></div>
    </div>
    <div><label class="font-mono text-[11px] uppercase">Excerpt</label><textarea name="excerpt" rows="3" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]">{{ old('excerpt',$article->excerpt) }}</textarea></div>
    <div>
      <label class="font-mono text-[11px] uppercase">Body</label>
      <div id="quill-editor" class="mt-1 bg-white text-bm-dark min-h-[260px]">{!! old('body',$article->body) !!}</div>
      <textarea name="body" id="body-hidden" class="hidden"></textarea>
    </div>
  </div>

  <div class="space-y-4">
    <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
      <label class="font-mono text-[11px] uppercase">Featured Image (re-encode WebP)</label>
      <input type="file" name="featured_image" accept="image/*" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px]">
      @if($article->featured_image)<div class="mt-2 text-[11px] font-mono">{{ $article->featured_image }}</div>@endif
      <div class="mt-4"><label class="font-mono text-[11px] uppercase">Published At</label><input type="datetime-local" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"></div>
      <div class="mt-4"><label class="font-mono text-[11px] uppercase">SEO Title</label><input name="seo_title" value="{{ old('seo_title',$article->seo_title) }}" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[13px]"></div>
      <div class="mt-2"><label class="font-mono text-[11px] uppercase">SEO Description</label><textarea name="seo_description" rows="3" class="mt-1 w-full bg-bm-cream border border-bm-dark/10 px-3 py-2 text-[12px]">{{ old('seo_description',$article->seo_description) }}</textarea></div>
      <button type="submit" class="mt-6 w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold">Simpan Artikel →</button>
    </div>
  </div>
</form>

<script src="/vendor/quill/quill.js"></script>
<script>
const quill = new Quill('#quill-editor', { theme: 'snow', modules: { toolbar: [['bold','italic','underline'],[{header:[2,3,false]}],['link','blockquote','code-block'], [{list:'ordered'},{list:'bullet'}], ['clean']] }});
document.getElementById('article-form').addEventListener('submit', function(){
  document.getElementById('body-hidden').value = quill.root.innerHTML;
});
</script>
@endsection
