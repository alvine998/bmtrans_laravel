@extends('layouts.app')
@section('content')
<section class="bg-bm-cream pt-10 pb-16">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-end justify-between gap-6">
      <div>
        <div class="label-industrial">Artikel & Insight</div>
        <h1 class="mt-3 font-display font-black text-[40px] sm:text-[56px] leading-[0.85] uppercase">Catatan dari<br><span class="text-bm-yellow">jalan & gudang</span></h1>
      </div>
      <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari: ODOL, tarif, regulasi..." class="bg-bm-cream-soft border border-bm-dark/10 px-4 py-2.5 text-[13px] w-[260px]">
        <button class="bg-bm-cream text-bm-dark px-5 py-2.5 font-display uppercase text-[12px]">Cari</button>
      </form>
    </div>

    @if(!empty($searchQuery))
      <div class="mt-4 font-mono text-[12px] text-bm-gray-light">Hasil untuk "<strong class="text-bm-dark">{{ $searchQuery }}</strong>" — {{ $articles->total() }} ditemukan</div>
    @endif

    <div class="mt-8 flex gap-2 flex-wrap font-mono text-[11px] uppercase">
      <a href="{{ route('articles.index') }}" class="px-3 py-1 border {{ !request('category') ? 'bg-bm-yellow text-bm-dark border-bm-yellow' : 'border-bm-dark/10' }}">Semua</a>
      @foreach($categories as $cat)
        <a href="{{ route('articles.index',['category'=>$cat->slug]) }}" class="px-3 py-1 border {{ request('category')===$cat->slug ? 'bg-bm-yellow text-bm-dark border-bm-yellow' : 'border-bm-dark/10 hover:bg-bm-dark/5' }}">{{ $cat->name }} ({{ $cat->articles_count }})</a>
      @endforeach
    </div>

    <div class="mt-10 grid md:grid-cols-3 gap-6">
      @forelse($articles as $art)
        <a href="{{ route('articles.show',$art->slug) }}" class="group bg-bm-cream-soft border border-bm-dark/5 hover:border-bm-dark/15 overflow-hidden">
          <div class="aspect-[16/10] bg-bm-cream-light relative">
            @if($art->featured_image)
              <img src="{{ asset('storage/'.$art->featured_image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition duration-500" loading="lazy">
            @endif
            <div class="absolute left-0 top-0 bg-bm-cream px-2 py-1 font-mono text-[10px] uppercase text-bm-yellow">{{ $art->category?->name }}</div>
          </div>
          <div class="p-5">
            <div class="font-mono text-[11px] text-bm-gray-light">{{ $art->published_at?->format('d M Y') }} • {{ $art->views }} views</div>
            <h2 class="mt-2 font-display font-bold uppercase text-[18px] leading-[0.9] group-hover:text-bm-yellow">{{ $art->title }}</h2>
            <p class="mt-2 text-[13px] text-bm-gray-light line-clamp-2">{{ $art->excerpt }}</p>
          </div>
        </a>
      @empty
        <div class="col-span-full py-16 text-center border border-dashed border-bm-dark/10 text-bm-gray-light">Tidak ada artikel untuk query ini.</div>
      @endforelse
    </div>

    <div class="mt-8">{{ $articles->links() }}</div>
  </div>
</section>
@endsection
