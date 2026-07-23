<?php

use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ArmadaController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ServiceController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

Route::get('/armada', [ArmadaController::class, 'index'])->name('armada.index');

// Sitemap updated to include armada

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');

Route::prefix('artikel')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    $services = \App\Models\Service::active()->ordered()->get();
    $articles = \App\Models\Article::published()->latest('published_at')->take(100)->get();
    $pages = ['/', '/layanan', '/armada', '/tentang-kami', '/galeri', '/kontak', '/artikel'];
    $content = view('sitemap', compact('services', 'articles', 'pages'))->render();
    return response($content, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// Robots
Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".url('/sitemap.xml')."\n", 200)->header('Content-Type', 'text/plain');
});

// Admin routes includes
require __DIR__.'/admin.php';
