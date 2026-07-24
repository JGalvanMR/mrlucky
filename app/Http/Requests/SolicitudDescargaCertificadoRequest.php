<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudDescargaCertificadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:150'],
            'puesto' => ['required', 'string', 'max:150'],
            'empresa' => ['required', 'string', 'max:150'],
            'correo' => ['required', 'email:rfc,dns', 'max:150'],
            'telefono' => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]{7,30}$/'],
            'contacto_gab' => ['required', 'string', 'max:150'],
            'uso' => ['required', 'string', 'max:' . config('certificaciones.uso_max_length', 500)],

            // Honeypot anti-spam: campo invisible que un humano nunca llena.
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'puesto.required' => 'El puesto es obligatorio.',
            'empresa.required' => 'La empresa es obligatoria.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico no es válido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono no es válido.',
            'contacto_gab.required' => 'El contacto en GAB es obligatorio.',
            'uso.required' => 'Debe describir el uso que dará al certificado.',
        ];
    }
}
