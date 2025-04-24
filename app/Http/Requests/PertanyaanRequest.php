<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PertanyaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pertanyaan' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'pertanyaan.required' => 'Pertanyaan harus diisi',
            'pertanyaan.string' => 'Pertanyaan harus berupa string',
            'pertanyaan.max' => 'Pertanyaan maksimal 255 karakter',
        ];
    }
}
