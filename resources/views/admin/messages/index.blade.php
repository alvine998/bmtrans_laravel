@extends('layouts.admin')
@section('title','Pesan Masuk')
@section('content')
<h1 class="font-display font-black text-[22px] uppercase">Pesan Masuk — {{ $messages->total() }}</h1>
@if(session('success'))<div class="mt-4 bg-green-500/10 border p-3 text-[13px]">{{ session('success') }}</div>@endif
<div class="mt-6 bg-bm-black-soft border border-white/10 divide-y divide-white/5">
  @foreach($messages as $m)
    <a href="{{ route('admin.messages.show',$m) }}" class="block p-4 hover:bg-white/[0.02] flex justify-between">
      <div><div class="font-display uppercase text-[13px]">{{ $m->name }} • {{ $m->email }} @if(!$m->is_read)<span class="ml-2 px-1 bg-bm-red text-white text-[10px]">UNREAD</span>@endif</div><div class="font-mono text-[11px] text-bm-gray-light line-clamp-1">{{ Str::limit($m->message,120) }}</div></div>
      <div class="font-mono text-[10px] text-bm-gray-light">{{ $m->created_at->format('d/m H:i') }}</div>
    </a>
  @endforeach
</div>
<div class="mt-4">{{ $messages->links() }}</div>
@endsection
