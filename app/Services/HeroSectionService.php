<?php

namespace App\Services;

use App\Models\HeroSection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class HeroSectionService
{

    private const STORAGE_FOLDER = 'uploads/hero';

    public function getHero(): ?HeroSection
    {
        return HeroSection::first();
    }

    public function upsert(array $data): HeroSection
    {
        return DB::transaction(function () use ($data) {
            try {
                $hero = HeroSection::first();

                Log::info('HeroSectionService upsert called', [
                    'is_update' => $hero !== null,
                    'has_path_foto' => isset($data['path_foto']),
                ]);

                if (isset($data['path_foto']) && $data['path_foto'] instanceof UploadedFile) {

                    if ($hero && $hero->path_foto) {
                        $this->deleteImage($hero->path_foto);
                    }

                    $imagePath = $this->storeImage($data['path_foto']);
                    if ($imagePath) {
                        $data['path_foto'] = $imagePath;
                    }
                }

                if ($hero) {
                    $hero->update($data);
                    Log::info('Hero section updated', [
                        'id' => $hero->id,
                        'nama_depan' => $hero->nama_depan,
                        'nama_belakang' => $hero->nama_belakang,
                    ]);
                } else {
                    $hero = HeroSection::create($data);
                    Log::info('Hero section created', [
                        'id' => $hero->id,
                        'nama_depan' => $hero->nama_depan,
                        'nama_belakang' => $hero->nama_belakang,
                    ]);
                }

                return $hero;
            } catch (\Exception $e) {
                Log::error('Failed to upsert hero section', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    public function storeImage(UploadedFile $file): ?string
    {
        try {
            if (!Storage::disk('public')->exists(self::STORAGE_FOLDER)) {
                Storage::disk('public')->makeDirectory(self::STORAGE_FOLDER, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = self::STORAGE_FOLDER . '/' . $filename;

            Storage::disk('public')->putFileAs(
                self::STORAGE_FOLDER,
                $file,
                $filename
            );

            Log::debug('Hero image stored', [
                'path' => $path,
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]);

            return $path;
        } catch (\Exception $e) {
            Log::error('Failed to store hero image', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
            ]);
            return null;
        }
    }

    public function deleteImage(?string $path): bool
    {
        if (empty($path)) {
            return true;
        }

        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                Log::info('Hero image deleted', ['path' => $path]);
            }
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to delete hero image', [
                'path' => $path,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    public function delete(HeroSection $hero): bool
    {
        return DB::transaction(function () use ($hero) {
            try {
                Log::info('HeroSectionService delete called', [
                    'id' => $hero->id,
                    'nama_lengkap' => $hero->nama_lengkap,
                ]);

                if ($hero->path_foto) {
                    $this->deleteImage($hero->path_foto);
                }

                $deleted = $hero->delete();

                Log::info('Hero section deleted', [
                    'id' => $hero->id,
                    'success' => $deleted,
                ]);

                return $deleted;
            } catch (\Exception $e) {
                Log::error('Failed to delete hero section', [
                    'id' => $hero->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    public function getImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return asset('storage/' . $path);
    }
}
