<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Format;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();
        return view('admin.articles.form', ['article' => new Article(), 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['body'] = clean($data['body']);
        $data['author_id'] = Auth::guard('admin')->id();
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $this->storeImage($request->file('featured_image'));
        }

        $article = Article::create($data);
        if (! empty($data['tags'])) $article->tags()->sync($data['tags']);

        return redirect()->route('admin.articles.index')->with('success','Artikel dibuat.');
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();
        return view('admin.articles.form', compact('article','categories','tags'));
    }

    public function update(StoreArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['body'] = clean($data['body']);
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = $data['published_at'] ?? now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $this->storeImage($request->file('featured_image'));
        }

        $article->update($data);
        $article->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.articles.index')->with('success','Artikel diupdate.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success','Artikel dihapus.');
    }

    private function storeImage($file): string
    {
        $manager = new ImageManager(GdDriver::class);
        $name = Str::random(32).'.webp';
        $rel = 'articles/'.$name;

        Storage::disk('public')->makeDirectory('articles');
        $full = Storage::disk('public')->path($rel);

        $manager->decodePath($file->getRealPath())
            ->scaleDown(width: 1600)
            ->encodeUsingFormat(Format::WEBP, quality: 80)
            ->save($full);

        return $rel;
    }
}
