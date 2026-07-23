<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateArmadaRequest extends FormRequest
{
    public function authorize(): bool { return Auth::guard('admin')->check(); }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:200'],
            'type' => ['nullable','string','max:100'],
            'price_start' => ['required','integer','min:0','max:999999999999'],
            'price_label' => ['nullable','string','max:50'],
            'price_note' => ['nullable','string','max:100'],
            'description' => ['nullable','string','max:1000'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
            'remove_image' => ['nullable','boolean'],
            'order' => ['nullable','integer','min:0','max:1000'],
            'is_active' => ['nullable','boolean'],
        ];
    }
}
