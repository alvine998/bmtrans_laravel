<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO --}}
  <title>{{ $seoTitle ?? ($metaTitle ?? config('app.name')) }}</title>
  <meta name="description" content="{{ $seoDescription ?? $metaDescription ?? 'PT Berkah Makmur Transport — Logistic Express terpercaya untuk pengiriman darat, laut, dan pergudangan di seluruh Indonesia.' }}">
  <link rel="canonical" href="{{ $canonical ?? url()->current() }}">
  <meta name="robots" content="{{ $robots ?? 'index, follow' }}">
  <meta name="theme-color" content="#F5F0E8">

  {{-- OG --}}
  <meta property="og:type" content="{{ $ogType ?? 'website' }}">
  <meta property="og:title" content="{{ $seoTitle ?? config('app.name') }}">
  <meta property="og:description" content="{{ $seoDescription ?? 'Logistik industri berat yang dapat diandalkan.' }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ $ogImage ?? asset('images/og-default.jpg') }}">
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta name="twitter:card" content="summary_large_image">

  {{-- Preload fonts (self-hosted) --}}
  <link rel="preload" href="/fonts/Oswald-Variable.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/fonts/PublicSans-Variable.woff2" as="font" type="font/woff2" crossorigin>

  {{-- Styles --}}
  <link rel="stylesheet" href="/css/app.css?v={{ filemtime(public_path('css/app.css')) }}">

  {{-- JSON-LD --}}
  @stack('schema')
</head>
<body class="bg-bm-cream text-bm-dark antialiased selection:bg-bm-red selection:text-white overflow-x-hidden">

  {{-- Top hazard stripe --}}
  <div class="hazard-stripe sticky top-0 z-[100]"></div>

  {{-- Navbar --}}
  @include('partials.navbar')

  <main id="main">
    @yield('content')
  </main>

  {{-- Sticky WhatsApp — Beranda + all public pages (can gate with @if(Route::is('home')) if needed) --}}
  @include('partials.whatsapp-float')

  {{-- Footer --}}
  @include('partials.footer')

  {{-- Vendor JS (self-hosted, deferred) --}}
  <script src="/vendor/lenis/lenis.min.js" defer></script>
  <script src="/vendor/gsap/gsap.min.js" defer></script>
  <script src="/vendor/gsap/ScrollTrigger.min.js" defer></script>
  <script src="/js/app.js?v={{ filemtime(public_path('js/app.js')) }}" defer></script>

  @stack('scripts')
</body>
</html>
