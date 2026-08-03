<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        return view('services.index', compact('services'), [
            'seoTitle' => 'Layanan Logistik | Trucking, Sea Freight, Air Freight',
            'seoDescription' => 'Layanan lengkap: pengiriman darat Sumatera-Jawa-Bali, sea freight, dan udara.',
            'canonical' => route('layanan.index'),
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $allowedSorts = ['title', 'order']; // whitelist example per security spec
        $sort = $request->query('sort');
        $sort = in_array($sort, $allowedSorts, true) ? $sort : 'order';

        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $otherServices = Service::active()->where('id', '!=', $service->id)->ordered()->take(3)->get();
        $relatedArticles = Article::published()->latest()->take(3)->get();

        return view('services.show', compact('service', 'otherServices', 'relatedArticles'), [
            'seoTitle' => $service->seo_title ?: $service->title . ' — PT Berkah Makmur Transport',
            'seoDescription' => $service->seo_description ?: $service->excerpt,
            'canonical' => route('layanan.show', $service->slug),
        ]);
    }
}
