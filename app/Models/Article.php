<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'category_id','title','slug','excerpt','body','featured_image',
        'author_id','status','published_at','seo_title','seo_description','views'
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'views' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function category(): BelongsTo { return $this->belongsTo(ArticleCategory::class, 'category_id'); }
    public function author(): BelongsTo { return $this->belongsTo(Admin::class, 'author_id'); }
    public function tags(): BelongsToMany { return $this->belongsToMany(ArticleTag::class, 'article_tag', 'article_id', 'article_tag_id'); }

    public function scopePublished($q)
    {
        return $q->where('status', 'published')->whereNotNull('published_at')->where('published_at', '<=', now());
    }
    public function scopeDraft($q) { return $q->where('status', 'draft'); }
}
