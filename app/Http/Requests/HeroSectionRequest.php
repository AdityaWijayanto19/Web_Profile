<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HeroSectionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['required', 'string', 'max:255'],
            'text_singkat' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'min:10'],
            'path_foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'link_cv' => ['nullable', 'string', 'max:255'],
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
            'nama_depan.required' => 'Nama depan wajib diisi.',
            'nama_depan.string' => 'Nama depan harus berupa teks.',
            'nama_depan.max' => 'Nama depan maksimal 255 karakter.',

            'nama_belakang.required' => 'Nama belakang wajib diisi.',
            'nama_belakang.string' => 'Nama belakang harus berupa teks.',
            'nama_belakang.max' => 'Nama belakang maksimal 255 karakter.',

            'text_singkat.required' => 'Text singkat wajib diisi.',
            'text_singkat.string' => 'Text singkat harus berupa teks.',
            'text_singkat.max' => 'Text singkat maksimal 255 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter.',

            'path_foto.image' => 'File harus berupa gambar.',
            'path_foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WebP.',
            'path_foto.max' => 'Ukuran gambar maksimal 10MB.',

            'link_cv.string' => 'Link CV harus berupa teks.',
            'link_cv.max' => 'Link CV maksimal 255 karakter.',
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
            'nama_depan' => 'Nama Depan',
            'nama_belakang' => 'Nama Belakang',
            'text_singkat' => 'Text Singkat',
            'deskripsi' => 'Deskripsi',
            'path_foto' => 'Foto',
            'link_cv' => 'Link CV',
        ];
    }
}
