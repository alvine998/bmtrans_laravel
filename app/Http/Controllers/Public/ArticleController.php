<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = ['published_at', 'views', 'title'];
        $sort = $request->query('sort');
        $sort = in_array($sort, $allowedSorts, true) ? $sort : 'published_at';
        $direction = $request->query('dir') === 'asc' ? 'asc' : 'desc';

        $query = Article::published()->with('category', 'author')->orderBy($sort, $direction);

        // search - bound parameters, no raw concatenation
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($cat = $request->query('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $cat));
        }

        $articles = $query->paginate(12)->withQueryString();
        $categories = ArticleCategory::withCount(['articles' => fn($q) => $q->where('status', 'published')])->get();

        return view('articles.index', compact('articles', 'categories'), [
            'seoTitle' => 'Artikel & Insight Logistik — Tips Pengiriman & Regulasi',
            'seoDescription' => 'Insight logistik industri: biaya trucking Sumatera-Jawa, regulasi ODOL, manajemen gudang.',
            'canonical' => route('articles.index'),
            'searchQuery' => $request->query('q'),
        ]);
    }

    public function show(string $slug)
    {
        $article = Article::published()->with('category', 'tags', 'author')->where('slug', $slug)->firstOrFail();
        $article->increment('views');

        $related = Article::published()->where('id', '!=', $article->id)
            ->when($article->category_id, fn($q) => $q->where('category_id', $article->category_id))
            ->latest('published_at')->take(3)->get();

        return view('articles.show', compact('article', 'related'), [
            'seoTitle' => $article->seo_title ?: $article->title,
            'seoDescription' => $article->seo_description ?: $article->excerpt,
            'canonical' => route('articles.show', $article->slug),
            'ogType' => 'article',
            'ogImage' => $article->featured_image ? asset('storage/'.$article->featured_image) : null,
        ]);
    }
}
