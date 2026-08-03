<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'services' => Service::count(),
                'armada' => Armada::count(),
                'articles' => Article::count(),
                'published' => Article::where('status', 'published')->count(),
                'gallery' => GalleryItem::count(),
                'testimonials' => Testimonial::count(),
                'messages' => ContactMessage::count(),
                'unread' => ContactMessage::unread()->count(),
            ],
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
            'recentArticles' => Article::latest()->take(5)->get(),
        ]);
    }
}
