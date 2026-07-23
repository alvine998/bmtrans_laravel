@extends('layouts.admin')
@section('title', $title ?? 'Admin')
@section('content')
<div class="label-industrial">Soon</div>
<h1 class="mt-2 font-display font-black text-[32px] uppercase">{{ $title ?? 'Module' }}</h1>
<p class="mt-4 text-bm-gray-light max-w-[60ch]">Modul {{ $title ?? '' }} dalam tahap pengembangan — struktur DB sudah siap, guard admin aktif, segera CRUD lengkap dengan Quill.js self-hosted, Purifier, image re-encode via Intervention, dan export.</p>
<div class="mt-6 p-4 bg-bm-yellow/10 border border-bm-yellow/20 font-mono text-[12px]">Phase 2: Layanan CRUD, Artikel CRUD + WYSIWYG, Gallery upload + WebP, Messages inbox, Settings key-value, Admin Users, Activity Log.</div>
@endsection
