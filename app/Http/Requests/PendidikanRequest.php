<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PendidikanRequest extends FormRequest
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

        // Dynamic validation untuk setiap pendidikan yang ada
        if ($this->has('pendidikans')) {
            foreach ($this->input('pendidikans', []) as $id => $data) {
                $rules["pendidikans.{$id}.gelar"] = ['required', 'string', 'max:255'];
                $rules["pendidikans.{$id}.instansi"] = ['required', 'string', 'max:255'];
                $rules["pendidikans.{$id}.periode"] = ['required', 'string', 'max:100'];
                $rules["pendidikans.{$id}.keterangan"] = ['nullable', 'string'];
                $rules["pendidikans.{$id}.urutan"] = ['required', 'integer', 'min:0'];
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
            'pendidikans.*.gelar.required' => 'Gelar wajib diisi.',
            'pendidikans.*.gelar.string' => 'Gelar harus berupa teks.',
            'pendidikans.*.gelar.max' => 'Gelar maksimal 255 karakter.',

            'pendidikans.*.instansi.required' => 'Instansi wajib diisi.',
            'pendidikans.*.instansi.string' => 'Instansi harus berupa teks.',
            'pendidikans.*.instansi.max' => 'Instansi maksimal 255 karakter.',

            'pendidikans.*.periode.required' => 'Periode wajib diisi.',
            'pendidikans.*.periode.string' => 'Periode harus berupa teks.',
            'pendidikans.*.periode.max' => 'Periode maksimal 100 karakter.',

            'pendidikans.*.keterangan.string' => 'Keterangan harus berupa teks.',

            'pendidikans.*.urutan.required' => 'Urutan wajib diisi.',
            'pendidikans.*.urutan.integer' => 'Urutan harus berupa angka.',
            'pendidikans.*.urutan.min' => 'Urutan minimal 0.',
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
            'gelar' => 'Gelar',
            'instansi' => 'Instansi',
            'periode' => 'Periode',
            'keterangan' => 'Keterangan',
            'urutan' => 'Urutan',
        ];
    }
}
