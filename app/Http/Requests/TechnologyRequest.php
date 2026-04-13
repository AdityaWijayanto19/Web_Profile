<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnologyRequest extends FormRequest
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
        $technologyId = $this->route('technology')?->id;

        return [
            'nama' => [
                'required',
                'string',
                'min:2',
                'max:100',
                Rule::unique('teknologis', 'nama')->ignore($technologyId),
            ],
            'path_icon' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[a-z0-9\-]+$/',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama teknologi harus diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.min' => 'Nama minimal 2 karakter',
            'nama.max' => 'Nama maksimal 100 karakter',
            'nama.unique' => 'Teknologi dengan nama ini sudah ada',

            'path_icon.required' => 'Nama icon harus diisi',
            'path_icon.string' => 'Icon harus berupa teks',
            'path_icon.min' => 'Nama icon minimal 2 karakter',
            'path_icon.max' => 'Nama icon maksimal 100 karakter',
            'path_icon.regex' => 'Icon harus berisi huruf kecil, angka, dan tanda hubung (contoh: ubuntu, react-native)',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Normalize icon name to lowercase
        $this->merge([
            'path_icon' => strtolower(trim($this->path_icon)),
        ]);
    }
}
