<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SertifikatRequest extends FormRequest
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
        $rules = [
            'nama_sertifikat' => ['required', 'string', 'max:255'],
            'penerbit' => ['required', 'string', 'max:255'],
            'path_gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'id_kredensial' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'link_kredensial' => ['nullable', 'url', 'max:255'],
            'start_year' => 'required|string|max:10',
            'end_year' => 'required|string|max:10',
        ];

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama_sertifikat.required' => 'Nama sertifikat wajib diisi.',
            'nama_sertifikat.string' => 'Nama sertifikat harus berupa teks.',
            'nama_sertifikat.max' => 'Nama sertifikat maksimal 255 karakter.',

            'penerbit.required' => 'Penerbit wajib diisi.',
            'penerbit.string' => 'Penerbit harus berupa teks.',
            'penerbit.max' => 'Penerbit maksimal 255 karakter.',

            'path_gambar.image' => 'File harus berupa gambar.',
            'path_gambar.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'path_gambar.max' => 'Ukuran gambar maksimal 5MB.',

            'id_kredensial.string' => 'ID kredensial harus berupa teks.',
            'id_kredensial.max' => 'ID kredensial maksimal 255 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',

            'link_kredensial.url' => 'Link kredensial harus berupa URL yang valid.',
            'link_kredensial.max' => 'Link kredensial maksimal 255 karakter.',
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
            'nama_sertifikat' => 'Nama Sertifikat',
            'penerbit' => 'Penerbit',
            'path_gambar' => 'Gambar Sertifikat',
            'id_kredensial' => 'ID Kredensial',
            'deskripsi' => 'Deskripsi',
            'link_kredensial' => 'Link Kredensial',
            'tahun' => 'Tahun',
        ];
    }
}
