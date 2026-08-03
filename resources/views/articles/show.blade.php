@extends('layouts.app')
@section('content')
<article class="bg-bm-cream text-bm-dark">
  <div class="hazard-stripe"></div>
  <div class="mx-auto max-w-[900px] px-4 sm:px-6 lg:px-8 py-12">
    <div class="font-mono text-[11px] uppercase tracking-widest text-bm-red font-bold">{{ $article->category?->name ?? 'LOGISTIK' }} • {{ $article->published_at?->format('d M Y') }}</div>
    <h1 class="mt-3 font-display font-black text-[36px] sm:text-[52px] leading-[0.85] uppercase">{{ $article->title }}</h1>
    @if($article->excerpt)<p class="mt-4 text-[18px] leading-relaxed opacity-70 border-l-2 border-bm-yellow pl-4">{{ $article->excerpt }}</p>@endif

    @if($article->featured_image)
      <div class="mt-8 aspect-[16/9] bg-bm-cream-soft overflow-hidden">
        <img src="{{ asset('storage/'.$article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover" loading="eager">
      </div>
    @endif

    <div class="mt-10 prose prose-zinc max-w-none prose-lg prose-p:leading-relaxed prose-headings:font-display prose-headings:uppercase">
      {!! $article->body !!}
    </div>

    @if($article->tags->count())
      <div class="mt-8 flex flex-wrap gap-2 font-mono text-[11px] uppercase">
        @foreach($article->tags as $tag)<span class="border border-bm-dark/10 px-2 py-1">#{{ $tag->name }}</span>@endforeach
      </div>
    @endif

    <div class="mt-12 border-t border-bm-dark/10 pt-8 flex justify-between items-center">
      <a href="{{ route('articles.index') }}" class="font-display uppercase text-[13px] border border-bm-dark/15 px-4 py-2">← Semua artikel</a>
      <a href="{{ route('contact') }}" class="bg-bm-red text-white px-5 py-2 font-display uppercase text-[13px]">Butuh angkutan? →</a>
    </div>
  </div>

  @if($related->count())
    <div class="bg-bm-dark text-bm-cream py-12">
      <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
        <div class="label-industrial">Lanjut baca</div>
        <div class="mt-6 grid md:grid-cols-3 gap-6">
          @foreach($related as $rel)
            <a href="{{ route('articles.show',$rel->slug) }}" class="border border-bm-dark/10 p-5 hover:border-bm-yellow/40">
              <div class="font-mono text-[11px] text-bm-gray-light">{{ $rel->published_at?->format('d M Y') }}</div>
              <div class="mt-2 font-display uppercase text-[16px]">{{ $rel->title }}</div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  @endif
</article>

@push('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Article',
  'headline' => $article->title,
  'datePublished' => $article->published_at?->toIso8601String(),
  'author' => ['@type' => 'Organization', 'name' => 'PT Berkah Makmur Transport']
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush
@endsection
