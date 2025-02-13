<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kriteria' => 'required|string|max:50',
            'bobot' => 'required|numeric|between:0,99.99',
            'jenis' => 'required|in:benefit,const',
        ];
    }

    public function massages(): array
    {
        return [
            'nama_kriteria.required' => 'Nama kriteria wajib diisi.',
            'nama_kriteria.string' => 'Nama kriteria harus berupa teks.',
            'nama_kriteria.max' => 'Nama kriteria maksimal 50 karakter.',

            'bobot.required' => 'Bobot wajib diisi.',
            'bobot.numeric' => 'Bobot harus berupa angka.',
            'bobot.between' => 'Bobot harus berada dalam rentang 0 hingga 99.99.',

            'jenis.required' => 'Jenis wajib diisi.',
            'jenis.in' => 'Jenis harus berupa "benefit" atau "const".',
        ];
    }
}
