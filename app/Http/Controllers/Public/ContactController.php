<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'kontak')->first();
        return view('contact.index', compact('page'), [
            'seoTitle' => $page?->seo_title ?? 'Hubungi Kami — Kantor Jakarta & Cabang Surabaya',
            'seoDescription' => 'Hubungi dispatch 24/7 untuk penawaran cepat. Kantor pusat Jakarta, cabang Surabaya.',
            'canonical' => route('contact'),
        ]);
    }

    public function store(StoreContactMessageRequest $request)
    {
        // honeypot check
        if ($request->filled('website_url')) {
            return back()->with('success', 'Pesan diterima, tim kami akan menghubungi Anda.');
        }

        ContactMessage::create([
            'name' => strip_tags($request->validated('name')),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'subject' => strip_tags($request->validated('subject') ?? ''),
            'message' => strip_tags($request->validated('message')),
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim dispatch akan menghubungi dalam 2 jam kerja.');
    }
}
