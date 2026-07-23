<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:200'],
            'slug' => ['nullable','string','max:200','unique:services,slug'],
            'excerpt' => ['nullable','string','max:500'],
            'body' => ['nullable','string'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'cover_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'order' => ['nullable','integer','min:0','max:1000'],
            'is_active' => ['nullable','boolean'],
            'seo_title' => ['nullable','string','max:200'],
            'seo_description' => ['nullable','string','max:500'],
            'features' => ['nullable','array'],
            'features.*' => ['string','max:200'],
        ];
    }
}
