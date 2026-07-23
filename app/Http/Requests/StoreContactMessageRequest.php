<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required','string','min:3','max:100'],
            'email' => ['required','email','max:150'],
            'phone' => ['nullable','string','max:30'],
            'subject' => ['nullable','string','max:200'],
            'message' => ['required','string','min:10','max:5000'],
            'website_url' => ['nullable','string','max:10'], // honeypot
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'message.required' => 'Pesan tidak boleh kosong.',
        ];
    }
}
