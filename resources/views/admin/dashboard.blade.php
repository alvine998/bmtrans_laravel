@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="flex items-end justify-between">
  <div><div class="label-industrial">Overview</div><h1 class="mt-2 font-display font-black text-[32px] uppercase">Dispatch Center</h1></div>
  <div class="font-mono text-[11px] text-bm-gray-light">{{ now()->format('d M Y H:i') }} WIB</div>
</div>

<div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5"><div class="font-mono text-[11px] uppercase text-bm-gray-light">Layanan Aktif</div><div class="font-display text-[28px]">{{ $stats['services'] }}</div></div>
  <a href="{{ route('admin.armada.index') }}" class="bg-bm-cream-soft border border-bm-yellow/30 p-5 hover:bg-bm-yellow/10"><div class="font-mono text-[11px] uppercase text-bm-yellow font-bold">Armada • Harga Mulai</div><div class="font-display text-[28px]">{{ $stats['armada'] ?? 0 }} <span class="text-[12px] font-mono">unit tarif</span></div></a>
  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5"><div class="font-mono text-[11px] uppercase text-bm-gray-light">Artikel / Published</div><div class="font-display text-[28px]">{{ $stats['articles'] }} / <span class="text-bm-yellow">{{ $stats['published'] }}</span></div></div>
  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5"><div class="font-mono text-[11px] uppercase text-bm-gray-light">Galeri</div><div class="font-display text-[28px]">{{ $stats['gallery'] }}</div></div>
  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5"><div class="font-mono text-[11px] uppercase text-bm-gray-light">Pesan Masuk</div><div class="font-display text-[28px]">{{ $stats['messages'] }} <span class="text-[14px] text-bm-red">({{ $stats['unread'] }} unread)</span></div></div>
  <div class="bg-bm-yellow text-bm-dark p-5"><div class="font-mono text-[11px] uppercase font-bold">Sistem</div><div class="font-display text-[18px] uppercase mt-1">Laravel 13 • No Vite • Tailwind 4</div></div>
</div>

<div class="mt-8 grid lg:grid-cols-2 gap-6">
  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div class="font-mono text-[11px] uppercase tracking-widest">Pesan terbaru</div>
    <div class="mt-4 space-y-3">
      @forelse($recentMessages as $m)
        <div class="p-3 bg-bm-cream border border-bm-dark/5 flex justify-between"><div><div class="font-display text-[13px] uppercase">{{ $m->name }} • {{ $m->email }}</div><div class="text-[12px] text-bm-gray-light line-clamp-1">{{ $m->message }}</div></div><div class="font-mono text-[10px] {{ $m->is_read?'text-bm-gray-light':'text-bm-red font-bold' }}">{{ $m->is_read?'read':'UNREAD' }}</div></div>
      @empty
        <div class="text-[13px] text-bm-gray-light">Belum ada pesan.</div>
      @endforelse
    </div>
  </div>
  <div class="bg-bm-cream-soft border border-bm-dark/10 p-5">
    <div class="font-mono text-[11px] uppercase tracking-widest">Artikel terbaru</div>
    <div class="mt-4 space-y-3">
      @forelse($recentArticles as $a)
        <div class="flex justify-between"><div class="font-display uppercase text-[13px]">{{ $a->title }}</div><span class="font-mono text-[10px] px-2 py-0.5 border border-bm-dark/10">{{ $a->status }}</span></div>
      @empty
        <div class="text-[13px] text-bm-gray-light">Belum ada artikel.</div>
      @endforelse
    </div>
  </div>
</div>
@endsection
