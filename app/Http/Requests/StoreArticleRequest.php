<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool { return Auth::guard('admin')->check(); }

    public function rules(): array
    {
        $articleId = $this->route('article')?->id;

        return [
            'title' => ['required','string','max:250'],
            'slug' => ['nullable','string','max:250','unique:articles,slug,'.$articleId],
            'category_id' => ['nullable','exists:article_categories,id'],
            'excerpt' => ['nullable','string','max:500'],
            'body' => ['required','string'],
            'featured_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
            'status' => ['required','in:draft,published'],
            'published_at' => ['nullable','date'],
            'seo_title' => ['nullable','string','max:250'],
            'seo_description' => ['nullable','string','max:500'],
            'tags' => ['nullable','array'],
            'tags.*' => ['exists:article_tags,id'],
        ];
    }
}
