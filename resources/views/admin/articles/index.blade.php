@extends('layouts.admin')
@section('title','Artikel')
@section('content')
<div class="flex items-center justify-between">
  <h1 class="font-display font-black text-[24px] uppercase">Artikel — {{ $articles->total() }}</h1>
  <a href="{{ route('admin.articles.create') }}" class="bg-bm-yellow text-bm-dark px-4 py-2 font-display uppercase text-[12px] font-bold">+ Artikel</a>
</div>
@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif
<div class="mt-6 bg-bm-cream-soft border border-bm-dark/10 overflow-x-auto">
  <table class="w-full text-[13px]">
    <thead class="font-mono text-[11px] uppercase text-bm-gray-light border-b border-bm-dark/5"><tr><th class="p-3 text-left">Judul</th><th class="p-3">Kategori</th><th class="p-3">Status</th><th class="p-3">Tgl</th><th class="p-3">Aksi</th></tr></thead>
    <tbody>
      @foreach($articles as $a)
        <tr class="border-b border-bm-dark/5">
          <td class="p-3 font-display uppercase text-[13px]">{{ Str::limit($a->title,50) }}</td>
          <td class="p-3 font-mono text-[11px]">{{ $a->category?->name }}</td>
          <td class="p-3"><span class="px-2 py-1 text-[10px] {{ $a->status==='published' ? 'bg-bm-yellow text-bm-dark' : 'bg-bm-dark/10' }}">{{ $a->status }}</span></td>
          <td class="p-3 font-mono text-[11px]">{{ $a->published_at?->format('d/m/Y') }}</td>
          <td class="p-3 flex gap-2"><a href="{{ route('admin.articles.edit',$a) }}" class="px-3 py-1 border border-bm-dark/10">Edit</a>
            <form method="POST" action="{{ route('admin.articles.destroy',$a) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="px-3 py-1 bg-bm-red/20 border border-bm-red/30 text-bm-red">Hapus</button></form></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $articles->links() }}</div>
@endsection
