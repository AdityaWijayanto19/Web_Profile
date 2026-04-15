<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hanya user terautentikasi yang bisa membuat/edit project
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Get project ID for update scenario (ignore in unique check)
        $projectId = $this->route('project')?->id;

        $rules = [
            // Title field
            'judul' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            // Description field
            'deskripsi' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],

            // Image file (optional, but if provided must be valid)
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048', // 2MB in KB
                'dimensions:min_width=100,min_height=100',
            ],

            // Demo link (optional)
            'link_demo' => [
                'nullable',
                'url',
                'max:500',
            ],

            // Repository link (optional)
            'link_repo' => [
                'nullable',
                'url',
                'max:500',
            ],

            // Order/sequence number - MUST BE UNIQUE
            'urutan' => [
                'nullable',
                'integer',
                'min:1',
                'max:9999',
                $projectId
                    ? "unique:proyeks,urutan,{$projectId},id"  // Update: ignore current project
                    : 'unique:proyeks,urutan',                 // Create: must be unique
            ],

            // Project status
            'status' => [
                'required',
                'string',
                'in:draft,published',
            ],

            // Technologies (many-to-many)
            'teknologis' => [
                'required',
                'array',
                'min:1',
            ],
            'teknologis.*' => [
                'required',
                'integer',
                'exists:teknologis,id',
            ],
        ];

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            // Judul messages
            'judul.required' => 'Judul proyek wajib diisi.',
            'judul.min' => 'Judul proyek harus minimal 3 karakter.',
            'judul.max' => 'Judul proyek maksimal 255 karakter.',
            'judul.string' => 'Judul proyek harus berupa teks.',

            // Deskripsi messages
            'deskripsi.required' => 'Deskripsi proyek wajib diisi.',
            'deskripsi.min' => 'Deskripsi harus minimal 10 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 5000 karakter.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            // Gambar messages
            'gambar.image' => 'File harus berupa gambar yang valid.',
            'gambar.mimes' => 'Format gambar harus JPG, PNG, atau WebP.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'gambar.dimensions' => 'Gambar harus minimal 100x100 pixel.',

            // Link demo messages
            'link_demo.url' => 'Link demo harus berupa URL yang valid.',
            'link_demo.max' => 'Link demo maksimal 500 karakter.',

            // Link repo messages
            'link_repo.url' => 'Link repository harus berupa URL yang valid.',
            'link_repo.max' => 'Link repository maksimal 500 karakter.',

            // Urutan messages
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 1, tidak boleh 0.',
            'urutan.max' => 'Urutan maksimal 9999.',
            'urutan.unique' => 'Urutan ini sudah digunakan oleh proyek lain. Pilih urutan yang berbeda.',

            // Status messages
            'status.required' => 'Status proyek wajib dipilih.',
            'status.in' => 'Status proyek harus Draft atau Published.',

            // Teknologis messages
            'teknologis.required' => 'Pilih minimal satu teknologi.',
            'teknologis.array' => 'Format teknologi tidak valid.',
            'teknologis.min' => 'Pilih minimal satu teknologi.',
            'teknologis.*.required' => 'Teknologi tidak boleh kosong.',
            'teknologis.*.integer' => 'Format teknologi tidak valid.',
            'teknologis.*.exists' => 'Teknologi yang dipilih tidak ditemukan.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'judul' => 'judul proyek',
            'deskripsi' => 'deskripsi',
            'gambar' => 'gambar proyek',
            'link_demo' => 'link demo',
            'link_repo' => 'link repository',
            'urutan' => 'urutan',
            'status' => 'status',
            'teknologis' => 'teknologi',
        ];
    }

    /**
     * Prepare data for validation by converting input.
     */
    public function prepareForValidation(): void
    {
        // Ensure teknologis is array if provided
        if ($this->has('teknologis') && is_string($this->teknologis)) {
            $this->merge([
                'teknologis' => json_decode($this->teknologis, true) ?? [],
            ]);
        }

        // Ensure urutan is integer or null
        if ($this->has('urutan') && $this->urutan === '') {
            $this->merge(['urutan' => null]);
        }
    }

    /**
     * Get only validated data needed for model creation/update
     */
    public function validated($key = null, $default = null): mixed
    {
        $validated = parent::validated($key, $default);

        // Remove gambar from validated if it's not a file (for update requests)
        if (isset($validated['gambar']) && !$validated['gambar'] instanceof \Illuminate\Http\UploadedFile) {
            unset($validated['gambar']);
        }

        return $validated;
    }
}
