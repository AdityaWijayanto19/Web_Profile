<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class ImageService
{
    /**
     * Image processing configuration
     */
    private const MAIN_WIDTH = 1200;
    private const WEBP_QUALITY = 85;
    private const STORAGE_PATH = 'uploads';

    private ImageManager $imageManager;

    public function __construct()
    {
        // Instantiate ImageManager with GD driver for v4
        $this->imageManager = new ImageManager(new Driver());
    }

    public function processUpload(UploadedFile $file, string $folder = 'projects'): ?string
    {
        try {
            $storagePath = self::STORAGE_PATH . "/{$folder}";

            // Ensure directory exists
            if (!Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->makeDirectory($storagePath, 0755, true);
            }

            // Decode image from uploaded file path
            $image = $this->imageManager->decodePath($file->getRealPath());
            $filename = Str::uuid() . '.webp';

            // Resize if needed
            if ($image->width() > self::MAIN_WIDTH) {
                $image = $image->scaleDown(width: self::MAIN_WIDTH);
            }

            // Encode to WebP and get encoded object
            $encoded = $image->encodeUsingFormat(Format::WEBP, quality: self::WEBP_QUALITY);

            // Save directly to storage
            $fullPath = "{$storagePath}/{$filename}";
            $storagePath = Storage::disk('public')->path($fullPath);

            // Ensure parent directory exists
            if (!is_dir(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            $encoded->save($storagePath);

            if (!file_exists($storagePath)) {
                throw new \Exception("Failed to verify saved file at {$storagePath}");
            }

            Log::debug("Image saved: {$fullPath}", [
                'width' => $image->width(),
                'height' => $image->height(),
                'size' => filesize($storagePath),
            ]);

            return $fullPath;
        } catch (\Throwable $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete image file from storage
     *
     * Safely handles file deletion with error logging
     *
     * @param string|null $path File path in storage
     * @return bool True if deleted or file not found, false if error
     */
    public function deleteFile(?string $path): bool
    {
        if (empty($path)) {
            return true; // Nothing to delete
        }

        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                Log::info("Image deleted: {$path}");
            }

            return true;
        } catch (\Throwable $e) {
            Log::error("Failed to delete image: {$path}", [
                'exception' => $e,
            ]);

            return false;
        }
    }

    /**
     * Delete project image
     *
     * Deletes the main image only
     *
     * @param string|null $mainPath Main image path
     * @return bool True if deleted successfully
     */
    public function deleteProjectImages(?string $mainPath): bool
    {
        return $this->deleteFile($mainPath);
    }

    /**
     * Get storage configuration info (for debugging/logging)
     *
     * @return array
     */
    public function getConfigInfo(): array
    {
        return [
            'main_width' => self::MAIN_WIDTH,
            'thumb_width' => self::THUMB_WIDTH,
            'webp_quality' => self::WEBP_QUALITY,
            'storage_path' => self::STORAGE_PATH,
        ];
    }
}
