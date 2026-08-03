@extends('layouts.app')
@section('content')
<section class="bg-bm-cream pt-10 pb-16">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between gap-6 flex-wrap">
      <div>
        <div class="label-industrial">Galeri</div>
        <h1 class="mt-3 font-display font-black text-[40px] sm:text-[56px] uppercase leading-[0.85]">Dokumentasi<br><span class="text-bm-yellow">lapangan.</span></h1>
      </div>
      <div class="flex gap-2 font-mono text-[11px] uppercase">
        @foreach(['all'=>'Semua','fleet'=>'Armada','warehouse'=>'Gudang','operations'=>'Operasional'] as $k=>$lbl)
          <a href="{{ route('gallery',['category'=>$k]) }}" class="px-3 py-2 border {{ $category===$k ? 'bg-bm-yellow text-bm-dark border-bm-yellow' : 'border-bm-dark/10 hover:bg-bm-dark/5' }}">{{ $lbl }}</a>
        @endforeach
      </div>
    </div>

    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
      @forelse($items as $item)
        <div class="group relative bg-bm-cream-soft border border-bm-dark/5 overflow-hidden">
          <div class="aspect-[4/3] bg-bm-cream-light flex items-center justify-center">
            @if($item->type==='image')
              <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->alt_text ?? $item->title }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition duration-500" loading="lazy">
            @else
              <span class="font-mono text-[11px]">VIDEO • {{ $item->title }}</span>
            @endif
          </div>
          <div class="p-3">
            <div class="font-mono text-[10px] text-bm-yellow uppercase">{{ $item->category }}</div>
            <div class="font-display uppercase text-[13px]">{{ $item->title }}</div>
          </div>
        </div>
      @empty
        <div class="col-span-full py-20 text-center border border-dashed border-bm-dark/10 font-mono text-bm-gray-light">Belum ada dokumentasi — tim lapangan akan upload setelah retur dari rute.</div>
      @endforelse
    </div>

    <div class="mt-8">{{ $items->links() }}</div>
  </div>
</section>
@endsection
