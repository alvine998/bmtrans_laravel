@extends('layouts.admin')
@section('title','Pengguna Admin')
@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
  <h1 class="font-display font-black text-[24px] uppercase">Pengguna Admin — {{ $users->total() }}</h1>
  <a href="{{ route('admin.users.create') }}" class="bg-bm-yellow text-bm-dark px-4 py-2 font-display uppercase text-[12px] font-bold text-center">+ Tambah Admin</a>
</div>

@if(session('success'))<div class="mt-4 bg-green-500/10 border border-green-500/20 p-3 text-[13px] text-green-800">{{ session('success') }}</div>@endif
@if(session('error'))<div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[13px] text-red-800">{{ session('error') }}</div>@endif

<form method="GET" class="mt-6 flex flex-col sm:flex-row gap-2">
  <input type="search" name="q" value="{{ $q }}" placeholder="Cari nama / email" class="flex-1 bg-bm-cream-soft border border-bm-dark/10 px-3 py-2 text-[13px]">
  <select name="role" class="bg-bm-cream-soft border border-bm-dark/10 px-3 py-2 text-[13px] font-mono">
    <option value="">Semua role</option>
    <option value="super_admin" @selected($role==='super_admin')>super_admin</option>
    <option value="editor" @selected($role==='editor')>editor</option>
  </select>
  <button class="bg-bm-dark/10 border border-bm-dark/10 px-4 py-2 font-mono text-[12px] uppercase">Filter</button>
</form>

<div class="mt-4 bg-bm-cream-soft border border-bm-dark/10 overflow-x-auto">
  <table class="w-full text-[13px]">
    <thead class="font-mono text-[11px] uppercase text-bm-gray-light border-b border-bm-dark/5">
      <tr>
        <th class="text-left p-3">Nama</th>
        <th class="text-left p-3">Email</th>
        <th class="text-left p-3">Role</th>
        <th class="text-left p-3">Status</th>
        <th class="text-left p-3">Login terakhir</th>
        <th class="text-left p-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $u)
        <tr class="border-b border-bm-dark/5 hover:bg-bm-dark/[0.02]">
          <td class="p-3 font-display uppercase">
            {{ $u->name }}
            @if(auth('admin')->id() === $u->id)<span class="ml-1 font-mono text-[10px] text-bm-yellow">ANDA</span>@endif
          </td>
          <td class="p-3 font-mono text-[11px] text-bm-gray-light">{{ $u->email }}</td>
          <td class="p-3">
            <span class="px-2 py-1 text-[10px] font-mono uppercase {{ $u->role === 'super_admin' ? 'bg-bm-red text-white' : 'bg-bm-dark/10' }}">{{ $u->role }}</span>
          </td>
          <td class="p-3">
            <span class="px-2 py-1 text-[10px] {{ $u->is_active ? 'bg-bm-yellow text-bm-dark' : 'bg-bm-dark/10' }}">{{ $u->is_active ? 'ACTIVE' : 'OFF' }}</span>
          </td>
          <td class="p-3 font-mono text-[11px] text-bm-gray-light">{{ $u->last_login_at?->format('d M Y H:i') ?? '—' }}</td>
          <td class="p-3 flex gap-2">
            <a href="{{ route('admin.users.edit', $u) }}" class="px-3 py-1 border border-bm-dark/10 hover:bg-bm-dark/5">Edit</a>
            @if(auth('admin')->id() !== $u->id)
              <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Hapus {{ $u->name }}?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 bg-bm-red/20 border border-bm-red/30 text-bm-red">Hapus</button>
              </form>
            @endif
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="p-6 text-center text-bm-gray-light font-mono text-[12px]">Belum ada pengguna.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
