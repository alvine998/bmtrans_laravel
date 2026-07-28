<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <title>@yield('title','Admin') — {{ config('app.name') }}</title>
  <link rel="stylesheet" href="/css/app.css?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="bg-bm-black text-bm-white min-h-screen flex">
  <aside class="w-[240px] bg-bm-black-soft border-r border-white/10 hidden lg:flex flex-col">
    <div class="p-5 border-b border-white/5">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-bm-red flex items-center justify-center font-display font-black">BM</div>
        <div class="leading-tight"><div class="font-display font-bold uppercase text-[13px]">BMT Admin</div><div class="font-mono text-[10px] text-bm-yellow">Super panel</div></div>
      </div>
    </div>
    <nav class="p-3 space-y-1 flex-1">
      <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 font-mono text-[12px] uppercase tracking-wide {{ request()->routeIs('admin.dashboard')?'bg-bm-yellow text-bm-black': 'text-bm-white/60 hover:text-white hover:bg-white/5' }}">Dashboard</a>
      <a href="{{ route('admin.pages.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase {{ request()->routeIs('admin.pages.*')?'bg-white/10 text-white':'text-bm-white/60 hover:text-white' }}">Konten Halaman</a>
      <a href="{{ route('admin.services.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase {{ request()->routeIs('admin.services.*')?'bg-white/10 text-white':'text-bm-white/60 hover:text-white' }}">Layanan</a>
      <a href="{{ route('admin.armada.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase {{ request()->routeIs('admin.armada.*')?'bg-bm-yellow text-bm-black font-bold':'text-bm-white/60 hover:text-white border border-bm-yellow/20' }}">Armada & Harga</a>
      <a href="{{ route('admin.articles.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase text-bm-white/60 hover:text-white">Artikel</a>
      <a href="{{ route('admin.gallery.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase text-bm-white/60 hover:text-white">Galeri</a>
      <a href="{{ route('admin.partners.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase text-bm-white/60 hover:text-white">Partner & Klien</a>
      <a href="{{ route('admin.messages.index') }}" class="block px-3 py-2 font-mono text-[12px] uppercase text-bm-white/60 hover:text-white">Pesan Masuk</a>
      <div class="h-px bg-white/5 my-3"></div>
      @if(auth('admin')->user()?->isSuperAdmin())
        <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 font-mono text-[11px] {{ request()->routeIs('admin.settings.*')?'text-bm-yellow':'text-bm-gray-light hover:text-white' }}">Pengaturan</a>
        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 font-mono text-[11px] {{ request()->routeIs('admin.users.*')?'text-bm-yellow':'text-bm-gray-light hover:text-white' }}">Pengguna Admin</a>
      @else
        <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 font-mono text-[11px] text-bm-gray-light/50">Pengaturan (read)</a>
      @endif
    </nav>
    <div class="p-3 border-t border-white/5">
      <div class="font-mono text-[11px]">{{ auth('admin')->user()?->name }} • {{ auth('admin')->user()?->role }}</div>
      <form method="POST" action="{{ route('admin.logout') }}" class="mt-2">@csrf<button class="w-full bg-bm-red py-2 font-display uppercase text-[12px]">Logout</button></form>
    </div>
  </aside>

  <div class="flex-1 flex flex-col min-w-0">
    <header class="lg:hidden bg-bm-black-soft border-b border-white/10 p-4 flex items-center justify-between">
      <span class="font-display font-bold uppercase">BM Admin</span>
      <span class="font-mono text-[11px]">{{ auth('admin')->user()?->email }}</span>
    </header>
    <main class="flex-1 p-4 sm:p-6 lg:p-8">
      @yield('content')
    </main>
  </div>
</body>
</html>
