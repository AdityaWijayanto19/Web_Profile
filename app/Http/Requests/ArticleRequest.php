<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'judul' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'isi_konten' => [
                'nullable',
                'string',
            ],
            'meta_description' => [
                'nullable',
                'string',
                'max:160',
            ],
            'menit_baca' => [
                'nullable',
                'integer',
                'min:1',
                'max:1000',
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],
            'path_gambar' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul artikel wajib diisi.',
            'judul.min' => 'Judul minimal 3 karakter.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'isi_konten.required' => 'Konten artikel wajib diisi.',
            'meta_description.max' => 'Meta description maksimal 160 karakter.',
            'menit_baca.integer' => 'Estimasi menit baca harus berupa angka.',
            'menit_baca.min' => 'Estimasi menit baca minimal 1 menit.',
            'path_gambar.required' => 'Silakan pilih gambar featured dari artikel Anda.',
        ];
    }
}
