@extends('layouts.admin')
@section('title','Armada — Harga')
@section('content')
<div class="flex items-center justify-between">
  <div>
    <h1 class="font-display font-black text-[24px] uppercase">Armada — {{ $armadas->total() }}</h1>
    <p class="font-mono text-[11px] text-bm-gray-light mt-1">Harga "Mulai dari" — edit angka rupiah, sistem tampil 200rb / 1,2jt otomatis, atau override label.</p>
  </div>
  <a href="{{ route('admin.armada.create') }}" class="bg-bm-yellow text-bm-dark px-4 py-2 font-display uppercase text-[12px] font-bold">+ Tambah Armada</a>
</div>

@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif

<div class="mt-6 bg-bm-cream-soft border border-bm-dark/10 overflow-x-auto">
  <table class="w-full text-[13px]">
    <thead class="font-mono text-[11px] uppercase text-bm-gray-light border-b border-bm-dark/5"><tr><th class="text-left p-3">Foto</th><th class="text-left p-3">Order</th><th class="text-left p-3">Nama</th><th class="text-left p-3">Tipe</th><th class="text-left p-3">Harga (Rp)</th><th class="text-left p-3">Label</th><th class="text-left p-3">Display</th><th class="text-left p-3">Aktif</th><th class="text-left p-3">Aksi</th></tr></thead>
    <tbody>
      @foreach($armadas as $a)
        <tr class="border-b border-bm-dark/5 hover:bg-bm-dark/[0.02]">
          <td class="p-2">
            @if($a->image_url)
              <img src="{{ $a->image_url }}" alt="{{ $a->name }}" class="w-[56px] h-[40px] object-cover border border-bm-dark/10 bg-bm-cream">
            @else
              <div class="w-[56px] h-[40px] bg-bm-cream border border-bm-dark/10 flex items-center justify-center font-mono text-[9px] text-bm-gray-light">NO IMG</div>
            @endif
          </td>
          <td class="p-3 font-mono">{{ $a->order }}</td>
          <td class="p-3 font-display uppercase">{{ $a->name }}</td>
          <td class="p-3 font-mono text-[11px] text-bm-yellow">{{ $a->type ?? '-' }}</td>
          <td class="p-3 font-mono">{{ number_format($a->price_start,0,',','.') }}</td>
          <td class="p-3 font-mono text-[11px]">{{ $a->price_label ?: '— auto' }}</td>
          <td class="p-3"><span class="inline-flex items-center gap-1 bg-bm-yellow text-bm-dark px-2 py-1 font-display font-bold text-[11px]">{{ $a->price_note }} Rp {{ $a->display_price }}</span></td>
          <td class="p-3"><span class="px-2 py-1 text-[10px] {{ $a->is_active ? 'bg-bm-yellow text-bm-dark' : 'bg-bm-dark/10' }}">{{ $a->is_active ? 'ACTIVE' : 'OFF' }}</span></td>
          <td class="p-3 flex gap-2">
            <a href="{{ route('admin.armada.edit',$a) }}" class="px-3 py-1 border border-bm-dark/10 hover:bg-bm-dark/5">Edit</a>
            <form method="POST" action="{{ route('admin.armada.destroy',$a) }}" onsubmit="return confirm('Hapus {{ $a->name }}?')">@csrf @method('DELETE')<button class="px-3 py-1 bg-bm-red/20 border border-bm-red/30 text-bm-red">Hapus</button></form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $armadas->links() }}</div>
@endsection
