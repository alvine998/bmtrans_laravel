@extends('layouts.admin')
@section('title','Layanan')
@section('content')
<div class="flex items-center justify-between">
  <h1 class="font-display font-black text-[24px] uppercase">Layanan — {{ $services->total() }}</h1>
  <a href="{{ route('admin.services.create') }}" class="bg-bm-yellow text-bm-black px-4 py-2 font-display uppercase text-[12px] font-bold">+ Tambah Layanan</a>
</div>

@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-200">{{ session('success') }}</div>@endif

<div class="mt-6 bg-bm-black-soft border border-white/10 overflow-x-auto">
  <table class="w-full text-[13px]">
    <thead class="font-mono text-[11px] uppercase text-bm-gray-light border-b border-white/5"><tr><th class="text-left p-3">Order</th><th class="text-left p-3">Judul</th><th class="text-left p-3">Slug</th><th class="text-left p-3">Aktif</th><th class="text-left p-3">Aksi</th></tr></thead>
    <tbody>
      @foreach($services as $s)
        <tr class="border-b border-white/5 hover:bg-white/[0.02]">
          <td class="p-3 font-mono">{{ $s->order }}</td>
          <td class="p-3 font-display uppercase">{{ $s->title }}</td>
          <td class="p-3 font-mono text-[11px] text-bm-gray-light">{{ $s->slug }}</td>
          <td class="p-3"><span class="px-2 py-1 text-[10px] {{ $s->is_active ? 'bg-bm-yellow text-bm-black' : 'bg-white/10' }}">{{ $s->is_active ? 'ACTIVE' : 'OFF' }}</span></td>
          <td class="p-3 flex gap-2">
            <a href="{{ route('admin.services.edit',$s) }}" class="px-3 py-1 border border-white/10 hover:bg-white/5">Edit</a>
            <form method="POST" action="{{ route('admin.services.destroy',$s) }}" onsubmit="return confirm('Hapus {{ $s->title }}?')">@csrf @method('DELETE')<button class="px-3 py-1 bg-bm-red/20 border border-bm-red/30 text-bm-red">Hapus</button></form>
            <a href="{{ route('layanan.show',$s->slug) }}" target="_blank" class="px-3 py-1 border border-bm-yellow/20 text-bm-yellow">Lihat</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $services->links() }}</div>
@endsection
