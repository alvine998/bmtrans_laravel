@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach($pages as $p)
    <url><loc>{{ url($p) }}</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
  @endforeach
  @foreach($services as $s)
    <url><loc>{{ route('layanan.show',$s->slug) }}</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
  @endforeach
  @foreach($articles as $a)
    <url><loc>{{ route('articles.show',$a->slug) }}</loc><lastmod>{{ $a->updated_at?->toAtomString() }}</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>
  @endforeach
</urlset>
