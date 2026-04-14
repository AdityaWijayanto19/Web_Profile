<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PengalamanRequest extends FormRequest
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
        $rules = [];

        // Dynamic validation untuk setiap pengalaman yang ada
        if ($this->has('pengalamans')) {
            foreach ($this->input('pengalamans', []) as $id => $data) {
                $rules["pengalamans.{$id}.jabatan"] = ['required', 'string', 'max:255'];
                $rules["pengalamans.{$id}.keterangan"] = ['nullable', 'string'];
                $rules["pengalamans.{$id}.urutan"] = ['required', 'integer', 'min:0'];
            }
        }

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
            'pengalamans.*.jabatan.required' => 'Jabatan wajib diisi.',
            'pengalamans.*.jabatan.string' => 'Jabatan harus berupa teks.',
            'pengalamans.*.jabatan.max' => 'Jabatan maksimal 255 karakter.',
            'pengalamans.*.keterangan.string' => 'Keterangan harus berupa teks.',
            'pengalamans.*.urutan.required' => 'Urutan wajib diisi.',
            'pengalamans.*.urutan.integer' => 'Urutan harus berupa angka.',
            'pengalamans.*.urutan.min' => 'Urutan minimal 0.',
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
            'jabatan' => 'Jabatan',
            'keterangan' => 'Keterangan',
            'urutan' => 'Urutan',
        ];
    }

            'urutan.*.required' => 'Urutan wajib diisi.',
            'urutan.*.integer' => 'Urutan harus berupa angka.',
            'urutan.*.min' => 'Urutan minimal 0.',
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
            'jabatan' => 'Jabatan',
            'keterangan' => 'Keterangan',
            'urutan' => 'Urutan',
        ];
    }
}
