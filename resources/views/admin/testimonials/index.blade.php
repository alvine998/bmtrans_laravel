@extends('layouts.admin')
@section('title','Testimoni')
@section('content')
<div class="flex items-center justify-between">
  <h1 class="font-display font-black text-[24px] uppercase">Testimoni — {{ $testimonials->total() }}</h1>
  <a href="{{ route('admin.testimonials.create') }}" class="bg-bm-yellow text-bm-dark px-4 py-2 font-display uppercase text-[12px] font-bold">+ Tambah Testimoni</a>
</div>

@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif

<div class="mt-6 bg-bm-cream-soft border border-bm-dark/10 overflow-x-auto">
  <table class="w-full text-[13px]">
    <thead class="font-mono text-[11px] uppercase text-bm-gray-light border-b border-bm-dark/5"><tr><th class="text-left p-3">Order</th><th class="text-left p-3">Nama</th><th class="text-left p-3">Perusahaan</th><th class="text-left p-3">Quote</th><th class="text-left p-3">Rating</th><th class="text-left p-3">Foto</th><th class="text-left p-3">Aktif</th><th class="text-left p-3">Aksi</th></tr></thead>
    <tbody>
      @forelse($testimonials as $t)
        <tr class="border-b border-bm-dark/5 hover:bg-bm-dark/[0.02]">
          <td class="p-3 font-mono">{{ $t->order }}</td>
          <td class="p-3 font-display uppercase">{{ $t->name }}</td>
          <td class="p-3 text-[12px] text-bm-gray-light">{{ $t->company ?? '—' }}</td>
          <td class="p-3 text-[12px] max-w-[200px] truncate">"{{ Str::limit($t->quote, 60) }}"</td>
          <td class="p-3 font-mono text-bm-yellow">{{ $t->order }}</td>
          <td class="p-3 font-mono text-bm-yellow">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</td>
          <td class="p-3">@if($t->photo)<img src="{{ asset('storage/'.$t->photo) }}" alt="" class="w-8 h-8 rounded-full object-cover bg-bm-cream border border-bm-dark/10">@else<span class="font-mono text-[11px] text-bm-gray-light">—</span>@endif</td>
          <td class="p-3"><span class="px-2 py-1 text-[10px] {{ $t->is_active ? 'bg-bm-yellow text-bm-dark' : 'bg-bm-dark/10' }}">{{ $t->is_active ? 'ACTIVE' : 'OFF' }}</span></td>
          <td class="p-3 flex gap-2">
            <a href="{{ route('admin.testimonials.edit',$t) }}" class="px-3 py-1 border border-bm-dark/10 hover:bg-bm-dark/5">Edit</a>
            <form method="POST" action="{{ route('admin.testimonials.destroy',$t) }}" onsubmit="return confirm('Hapus testimoni {{ $t->name }}?')">@csrf @method('DELETE')<button class="px-3 py-1 bg-bm-red/20 border border-bm-red/30 text-bm-red">Hapus</button></form>
          </td>
        </tr>
      @empty
        <tr><td colspan="8" class="p-6 text-center font-mono text-[12px] text-bm-gray-light">Belum ada testimoni.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $testimonials->links() }}</div>
@endsection
