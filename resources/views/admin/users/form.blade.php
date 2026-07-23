@extends('layouts.admin')
@section('title', $admin->exists ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('content')
<div class="flex items-center justify-between gap-3">
  <h1 class="font-display font-black text-[22px] uppercase">{{ $admin->exists ? 'Edit' : 'Tambah' }} Pengguna Admin</h1>
  <a href="{{ route('admin.users.index') }}" class="font-mono text-[11px] uppercase text-bm-gray-light hover:text-white">← Kembali</a>
</div>

@if($errors->any())
  <div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[12px]">@foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach</div>
@endif
@if(session('error'))
  <div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[13px] text-red-200">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ $admin->exists ? route('admin.users.update', $admin) : route('admin.users.store') }}" class="mt-6 max-w-xl space-y-4 bg-bm-black-soft border border-white/10 p-5">
  @csrf
  @if($admin->exists) @method('PUT') @endif

  <div>
    <label class="font-mono text-[11px] uppercase">Nama *</label>
    <input name="name" value="{{ old('name', $admin->name) }}" required maxlength="120" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[14px]">
  </div>

  <div>
    <label class="font-mono text-[11px] uppercase">Email *</label>
    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required maxlength="255" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px] font-mono">
  </div>

  <div class="grid sm:grid-cols-2 gap-3">
    <div>
      <label class="font-mono text-[11px] uppercase">Password {{ $admin->exists ? '(kosong = tetap)' : '*' }}</label>
      <input type="password" name="password" {{ $admin->exists ? '' : 'required' }} autocomplete="new-password" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]">
      <p class="mt-1 font-mono text-[10px] text-bm-gray-light">Min 10 karakter, tidak boleh password bocor umum.</p>
    </div>
    <div>
      <label class="font-mono text-[11px] uppercase">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" {{ $admin->exists ? '' : 'required' }} autocomplete="new-password" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px]">
    </div>
  </div>

  <div class="grid sm:grid-cols-2 gap-3">
    <div>
      <label class="font-mono text-[11px] uppercase">Role *</label>
      <select name="role" class="mt-1 w-full bg-bm-black border border-white/10 px-3 py-2 text-[13px] font-mono">
        <option value="editor" @selected(old('role', $admin->role) === 'editor')>editor — konten saja</option>
        <option value="super_admin" @selected(old('role', $admin->role) === 'super_admin')>super_admin — penuh</option>
      </select>
    </div>
    <div class="flex items-end pb-2">
      <label class="flex items-center gap-2 font-mono text-[11px] uppercase">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $admin->is_active ?? true))>
        Akun aktif
      </label>
    </div>
  </div>

  <div class="border border-bm-yellow/20 bg-bm-yellow/5 p-3 font-mono text-[11px] text-bm-gray-light space-y-1">
    <div><span class="text-bm-yellow">super_admin</span> — settings, pengguna, semua CMS</div>
    <div><span class="text-bm-yellow">editor</span> — layanan, artikel, galeri, pesan, konten (bukan settings/users)</div>
  </div>

  <button type="submit" class="w-full bg-bm-red py-3 font-display uppercase text-[13px] font-bold">Simpan Pengguna →</button>
</form>
@endsection
