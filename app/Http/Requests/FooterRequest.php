<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_web' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'media_sozials' => 'nullable|array',
            'media_sozials.*.technology_id' => 'required_with:media_sozials|integer|exists:teknologis,id',
            'media_sozials.*.url' => 'required_with:media_sozials|url',
            'media_sozials.*.urutan' => 'nullable|integer|min:0',
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
            'nama_web.required' => 'Nama website wajib diisi',
            'nama_web.max' => 'Nama website maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'email.email' => 'Format email tidak valid',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter',
            'logo_path.image' => 'Logo harus berupa gambar',
            'logo_path.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'logo_path.max' => 'Ukuran gambar maksimal 2MB',
            'media_sozials.*.technology_id.required_with' => 'Technology wajib dipilih untuk setiap media sosial',
            'media_sozials.*.technology_id.exists' => 'Technology yang dipilih tidak valid',
            'media_sozials.*.url.required_with' => 'URL wajib diisi untuk setiap media sosial',
            'media_sozials.*.url.url' => 'Format URL tidak valid',
        ];
    }
}
