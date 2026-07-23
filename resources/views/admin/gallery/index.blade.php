@extends('layouts.admin')
@section('title','Galeri')
@section('content')
<div class="flex items-center justify-between"><h1 class="font-display font-black text-[22px] uppercase">Galeri — {{ $items->total() }}</h1><a href="{{ route('admin.gallery.create') }}" class="bg-bm-yellow text-bm-black px-4 py-2 font-display uppercase text-[12px] font-bold">+ Upload</a></div>
@if(session('success'))<div class="mt-4 bg-green-500/10 border p-3 text-[13px] text-green-200">{{ session('success') }}</div>@endif
<div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-3">
  @foreach($items as $it)
    <div class="bg-bm-black-soft border border-white/10 p-2">
      <div class="aspect-[4/3] bg-bm-black flex items-center justify-center overflow-hidden">
        @if($it->type==='image')<img src="{{ asset('storage/'.$it->file_path) }}" class="w-full h-full object-cover">@else<span class="font-mono text-[10px]">VIDEO</span>@endif
      </div>
      <div class="mt-2 font-mono text-[11px]">{{ $it->title }} • {{ $it->category }}</div>
      <form method="POST" action="{{ route('admin.gallery.destroy',$it) }}" onsubmit="return confirm('Hapus?')" class="mt-2">@csrf @method('DELETE')<button class="w-full bg-bm-red/20 border border-bm-red/30 text-bm-red py-1 text-[11px]">Hapus</button></form>
    </div>
  @endforeach
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
