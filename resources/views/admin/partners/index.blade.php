@extends('layouts.admin')
@section('title','Partner & Klien')
@section('content')
<div class="flex items-center justify-between">
  <h1 class="font-display font-black text-[24px] uppercase">Partner & Klien — {{ $partners->total() }}</h1>
  <a href="{{ route('admin.partners.create') }}" class="bg-bm-yellow text-bm-dark px-4 py-2 font-display uppercase text-[12px] font-bold">+ Tambah Partner</a>
</div>

@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif

<div class="mt-6 bg-bm-cream-soft border border-bm-dark/10 overflow-x-auto">
  <table class="w-full text-[13px]">
    <thead class="font-mono text-[11px] uppercase text-bm-gray-light border-b border-bm-dark/5"><tr><th class="text-left p-3">Order</th><th class="text-left p-3">Nama</th><th class="text-left p-3">Logo</th><th class="text-left p-3">URL</th><th class="text-left p-3">Aktif</th><th class="text-left p-3">Aksi</th></tr></thead>
    <tbody>
      @foreach($partners as $p)
        <tr class="border-b border-bm-dark/5 hover:bg-bm-dark/[0.02]">
          <td class="p-3 font-mono">{{ $p->order }}</td>
          <td class="p-3 font-display uppercase">{{ $p->name }}</td>
          <td class="p-3">@if($p->logo)<img src="{{ asset('storage/'.$p->logo) }}" alt="" class="w-10 h-10 object-contain bg-bm-cream border border-bm-dark/10">@else<span class="font-mono text-[11px] text-bm-gray-light">—</span>@endif</td>
          <td class="p-3 font-mono text-[11px] text-bm-gray-light truncate max-w-[150px]">{{ $p->url ?? '—' }}</td>
          <td class="p-3"><span class="px-2 py-1 text-[10px] {{ $p->is_active ? 'bg-bm-yellow text-bm-dark' : 'bg-bm-dark/10' }}">{{ $p->is_active ? 'ACTIVE' : 'OFF' }}</span></td>
          <td class="p-3 flex gap-2">
            <a href="{{ route('admin.partners.edit',$p) }}" class="px-3 py-1 border border-bm-dark/10 hover:bg-bm-dark/5">Edit</a>
            <form method="POST" action="{{ route('admin.partners.destroy',$p) }}" onsubmit="return confirm('Hapus {{ $p->name }}?')">@csrf @method('DELETE')<button class="px-3 py-1 bg-bm-red/20 border border-bm-red/30 text-bm-red">Hapus</button></form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $partners->links() }}</div>
@endsection
