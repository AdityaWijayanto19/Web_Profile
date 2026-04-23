<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendidikanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array|string>
     */
    public function rules(): array
    {
        return [
            'start_year' => 'required|string|max:10',
            'end_year' => 'required|string|max:10',
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'start_year.required' => 'Tahun mulai wajib diisi.',
            'start_year.string' => 'Tahun mulai harus berupa teks.',
            'start_year.max' => 'Tahun mulai maksimal 10 karakter.',

            'end_year.required' => 'Tahun selesai wajib diisi.',
            'end_year.string' => 'Tahun selesai harus berupa teks.',
            'end_year.max' => 'Tahun selesai maksimal 10 karakter.',

            'degree.required' => 'Gelar/Jurusan wajib diisi.',
            'degree.string' => 'Gelar/Jurusan harus berupa teks.',
            'degree.max' => 'Gelar/Jurusan maksimal 255 karakter.',

            'institution.required' => 'Institusi/Universitas wajib diisi.',
            'institution.string' => 'Institusi/Universitas harus berupa teks.',
            'institution.max' => 'Institusi/Universitas maksimal 255 karakter.',

            'description.string' => 'Deskripsi harus berupa teks.',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'start_year' => 'Tahun Mulai',
            'end_year' => 'Tahun Selesai',
            'degree' => 'Gelar/Jurusan',
            'institution' => 'Institusi/Universitas',
            'description' => 'Deskripsi',
        ];
    }

    public function toModelData(): array
    {
        return [
            'gelar' => $this->input('degree'),
            'instansi' => $this->input('institution'),
            'periode' => "{$this->input('start_year')} - {$this->input('end_year')}",
            'keterangan' => $this->input('description'),
        ];
    }
}
