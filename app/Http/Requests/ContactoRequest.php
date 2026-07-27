<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'area' => ['required', 'string', Rule::in(array_keys(config('contacto.areas', [])))],
            'nombre' => ['required', 'string', 'max:150'],
            'empresa' => ['nullable', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'ciudad' => ['required', 'string', 'max:150'],
            'comentarios' => ['required', 'string', 'max:2000'],

            // Honeypot anti-spam
            'website' => ['nullable', 'max:0'],
        ];
    }
}
