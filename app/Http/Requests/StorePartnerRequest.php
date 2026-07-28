<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:partners,slug',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'url' => 'nullable|url|max:500',
            'order' => 'nullable|integer|min:0|max:32000',
            'is_active' => 'boolean',
        ];
    }
}
