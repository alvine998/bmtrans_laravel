<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login Admin — {{ config('app.name') }}</title>
  <link rel="stylesheet" href="/css/app.css?v={{ filemtime(public_path('css/app.css')) }}">
</head>

<body class="bg-bm-black min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-[420px]">
    <div class="hazard-stripe"></div>
    <div class="bg-bm-black-soft border border-white/10 p-8">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-bm-red flex items-center justify-center font-display font-black text-xl">BM</div>
        <div>
          <div class="font-display font-black uppercase text-[18px]">Admin Login</div>
          <div class="font-mono text-[10px] text-bm-yellow uppercase tracking-widest">Berkah Makmur Transport</div>
        </div>
      </div>

      @if($errors->any())
      <div class="mt-6 bg-bm-red/10 border border-bm-red/30 p-3 text-[13px] text-red-200">
        @foreach($errors->all() as $e) <div>• {{ $e }}</div> @endforeach
      </div>
      @endif
      @if(session('error'))
      <div class="mt-4 bg-bm-red/10 border border-bm-red/30 p-3 text-[13px] text-red-200">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login.post') }}" class="mt-8 space-y-5">
        @csrf
        <div>
          <label class="font-mono text-[11px] uppercase tracking-widest">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full bg-bm-black border border-white/10 px-4 py-3 text-[14px] focus:border-bm-yellow outline-none" placeholder="admin@berkahmakmur.co.id">
        </div>
        <div>
          <label class="font-mono text-[11px] uppercase tracking-widest">Password</label>
          <input type="password" name="password" required class="mt-2 w-full bg-bm-black border border-white/10 px-4 py-3 text-[14px] focus:border-bm-yellow outline-none" placeholder="••••••••••">
        </div>
        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 font-mono text-[11px] uppercase"><input type="checkbox" name="remember" class="accent-bm-red"> Ingat saya</label>
        </div>
        <button type="submit" class="w-full bg-bm-red py-3.5 font-display font-bold uppercase tracking-wide text-[13px] hover:bg-bm-red-dark">Masuk Dashboard →</button>
      </form>
    </div>
  </div>
</body>

</html>