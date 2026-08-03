<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'tentang-kami')->first();
        $team = TeamMember::where('is_active', true)->orderBy('order')->get();

        return view('about.index', compact('page', 'team'), [
            'seoTitle' => $page?->seo_title ?? 'Tentang Kami — Legalitas, Armada, Visi Misi',
            'seoDescription' => $page?->seo_description ?? 'PT Berkah Makmur Transport berdiri 2017, armada 120+ unit, gudang 5000m2, legalitas lengkap.',
            'canonical' => route('about'),
        ]);
    }
}
