<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ArmadaController as AdminArmadaController;
use App\Http\Controllers\Admin\ContactMessageController as AdminMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
    });

    Route::middleware(['admin.auth'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Services CRUD
        Route::resource('services', AdminServiceController::class)->except(['show']);
        // Armada CRUD — editable pricing
        Route::resource('armada', AdminArmadaController::class)->except(['show']);
        // Articles CRUD
        Route::resource('articles', AdminArticleController::class)->except(['show']);
        // Gallery
        Route::resource('gallery', AdminGalleryController::class)->only(['index','create','store','destroy']);

        // Messages
        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/read', [AdminMessageController::class, 'markRead'])->name('messages.read');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        // Pages / Konten Halaman - all admins can edit, slug rename super_admin only enforced in controller
        Route::get('/pages', [AdminPageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{page}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [AdminPageController::class, 'update'])->name('pages.update');

        // Partners
        Route::resource('partners', AdminPartnerController::class)->except(['show']);

        // Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update')->middleware('admin.role:super_admin');

        Route::middleware(['admin.role:super_admin'])->group(function () {
            Route::resource('users', AdminUserController::class)->except(['show'])->parameters(['users' => 'admin']);
            Route::get('/testimonials', fn() => view('admin.placeholder', ['title' => 'Testimoni'] ))->name('testimonials.index');
            Route::get('/team', fn() => view('admin.placeholder', ['title' => 'Tim'] ))->name('team.index');
        });
    });
});
