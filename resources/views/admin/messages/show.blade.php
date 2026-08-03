@extends('layouts.admin')
@section('title','Detail Pesan')
@section('content')
<div class="max-w-[720px] bg-bm-cream-soft border border-bm-dark/10 p-6">
  <div class="font-mono text-[11px] uppercase text-bm-yellow">{{ $message->created_at->format('d M Y H:i') }} • IP {{ $message->ip_address }}</div>
  <h1 class="mt-2 font-display font-black text-[22px] uppercase">{{ $message->name }} — {{ $message->subject }}</h1>
  <div class="mt-1 font-mono text-[12px] text-bm-gray-light">{{ $message->email }} • {{ $message->phone }}</div>
  <div class="mt-6 p-4 bg-bm-cream border border-bm-dark/5 text-[14px] leading-relaxed whitespace-pre-wrap">{{ $message->message }}</div>

  <div class="mt-6 flex gap-3">
    <form method="POST" action="{{ route('admin.messages.read',$message) }}">@csrf<button class="px-4 py-2 bg-bm-yellow text-bm-dark font-display uppercase text-[12px]">{{ $message->replied_at ? 'Tandai dibalas '. $message->replied_at->format('d/m') : 'Tandai sudah dibalas' }}</button></form>
    <form method="POST" action="{{ route('admin.messages.destroy',$message) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="px-4 py-2 border border-bm-red/30 text-bm-red text-[12px]">Hapus</button></form>
    <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 border border-bm-dark/10 text-[12px]">Kembali</a>
  </div>
</div>
@endsection
