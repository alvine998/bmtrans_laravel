<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $allowedCategories = ['fleet', 'warehouse', 'operations', 'all'];
        $category = $request->query('category', 'all');
        $category = in_array($category, $allowedCategories, true) ? $category : 'all';

        $query = GalleryItem::active()->orderBy('order');
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        $items = $query->paginate(24)->withQueryString();
        $categories = GalleryItem::active()->select('category')->distinct()->pluck('category')->filter();

        return view('gallery.index', compact('items', 'categories', 'category'), [
            'seoTitle' => 'Galeri Armada & Operasional',
            'seoDescription' => 'Dokumentasi fleet, warehouse, dan operasional lapangan PT Berkah Makmur Transport.',
            'canonical' => route('gallery'),
        ]);
    }
}
