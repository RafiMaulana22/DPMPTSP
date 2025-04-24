<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PilihanRequest extends FormRequest
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
            'pilihan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:0|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'pilihan.required' => 'Pilihan wajib diisi.',
            'pilihan.string' => 'Pilihan harus berupa teks.',
            'pilihan.max' => 'Pilihan tidak boleh lebih dari 255 karakter.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.integer' => 'Nilai harus berupa angka.',
            'nilai.min' => 'Nilai tidak boleh kurang dari 0.',
            'nilai.max' => 'Nilai tidak boleh lebih dari 100.',
        ];
    }
}
