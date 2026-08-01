<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->take(4)->get();
        $armadas = Armada::active()->ordered()->take(12)->get();
        $testimonials = Testimonial::active()->orderBy('order')->take(6)->get();
        $articles = Article::published()->with('category')->latest('published_at')->take(3)->get();
        $gallery = GalleryItem::active()->orderBy('order')->take(8)->get();
        $partners = Partner::active()->ordered()->get();
        $page = Page::where('slug','beranda')->first();

        // Merge: SEO from pages has priority, fallback to SiteSetting, then hardcoded
        $seoTitle = $page?->seo_title
            ?? SiteSetting::getValue('seo.home_title', 'PT Berkah Makmur Transport — Logistic Express Sumatera Jawa | Armada 24/7');
        $seoDescription = $page?->seo_description
            ?? SiteSetting::getValue('seo.home_description', 'Jasa logistik dan transportasi Indonesia sejak 2010. Armada lengkap, GPS real-time, asuransi penuh. Hubungi untuk penawaran terbaik.');

        return view('home.index', compact('services', 'armadas', 'testimonials', 'articles', 'gallery', 'page', 'partners'), [
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'canonical' => route('home'),
            'ogType' => 'website',
        ]);
    }
}
