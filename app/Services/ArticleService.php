<?php

namespace App\Services;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleService
{
    /**
     * ImageService instance for image processing
     */
    private ImageService $imageService;

    /**
     * Per page items for pagination
     */
    private const PER_PAGE = 10;

    /**
     * Inject dependencies
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Get paginated draft articles for a user
     *
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getDrafts(User $user): LengthAwarePaginator
    {
        return Artikel::where('user_id', $user->id)
            ->draft()
            ->ordered()
            ->paginate(self::PER_PAGE);
    }

    /**
     * Get paginated published articles for a user
     *
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getPublished(User $user): LengthAwarePaginator
    {
        return Artikel::where('user_id', $user->id)
            ->published()
            ->ordered()
            ->paginate(self::PER_PAGE);
    }

    /**
     * Create a new draft article automatically
     *
     * @param User $user
     * @return Artikel
     * @throws \Exception
     */
    public function createDraft(User $user): Artikel
    {
        return DB::transaction(function () use ($user) {
            try {
                $artikel = Artikel::create([
                    'user_id' => $user->id,
                    'judul' => 'Untitled Article',
                    'slug' => 'untitled-article-' . Str::random(8),
                    'isi_konten' => json_encode(['blocks' => []]),
                    'status' => 'draft',
                ]);

                Log::info('Draft article created', [
                    'artikel_id' => $artikel->id,
                    'user_id' => $user->id,
                ]);

                return $artikel;
            } catch (\Exception $e) {
                Log::error('Failed to create draft article', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Save article content (both title and editor content)
     *
     * @param Artikel $artikel
     * @param array $data
     * @return Artikel
     * @throws \Exception
     */
    public function saveContent(Artikel $artikel, array $data): Artikel
    {
        return DB::transaction(function () use ($artikel, $data) {
            try {
                $updateData = [];

                if (isset($data['judul'])) {
                    $updateData['judul'] = $data['judul'];
                }

                if (isset($data['isi_konten'])) {
                    $updateData['isi_konten'] = $data['isi_konten'];
                }

                if (isset($data['path_gambar'])) {
                    $updateData['path_gambar'] = $data['path_gambar'];
                }

                $artikel->update($updateData);

                Log::info('Article content saved', [
                    'artikel_id' => $artikel->id,
                    'has_judul' => isset($data['judul']),
                    'has_isi_konten' => isset($data['isi_konten']),
                ]);

                return $artikel;
            } catch (\Exception $e) {
                Log::error('Failed to save article content', [
                    'artikel_id' => $artikel->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Update article with metadata (before publish)
     *
     * @param Artikel $artikel
     * @param array $data
     * @return Artikel
     * @throws \Exception
     */
    public function updateMetadata(Artikel $artikel, array $data): Artikel
    {
        return DB::transaction(function () use ($artikel, $data) {
            try {
                $updateData = [];

                if (isset($data['judul'])) {
                    $updateData['judul'] = $data['judul'];
                    // Auto generate slug if not provided
                    if (!isset($data['slug'])) {
                        $updateData['slug'] = Str::slug($data['judul']) . '-' . time();
                    }
                }

                if (isset($data['slug'])) {
                    $updateData['slug'] = $data['slug'];
                }

                if (isset($data['meta_description'])) {
                    $updateData['meta_description'] = $data['meta_description'];
                }

                if (isset($data['menit_baca'])) {
                    $updateData['menit_baca'] = $data['menit_baca'];
                }

                if (isset($data['isi_konten'])) {
                    $updateData['isi_konten'] = $data['isi_konten'];
                }

                $artikel->update($updateData);

                Log::info('Article metadata updated', [
                    'artikel_id' => $artikel->id,
                    'fields_updated' => array_keys($updateData),
                ]);

                return $artikel;
            } catch (\Exception $e) {
                Log::error('Failed to update article metadata', [
                    'artikel_id' => $artikel->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Publish article
     *
     * @param Artikel $artikel
     * @return Artikel
     * @throws \Exception
     */
    public function publish(Artikel $artikel): Artikel
    {
        return DB::transaction(function () use ($artikel) {
            try {
                $artikel->update([
                    'status' => 'publish',
                    'tanggal_rilis' => now(),
                ]);

                Log::info('Article published', [
                    'artikel_id' => $artikel->id,
                    'user_id' => $artikel->user_id,
                    'judul' => $artikel->judul,
                ]);

                return $artikel;
            } catch (\Exception $e) {
                Log::error('Failed to publish article', [
                    'artikel_id' => $artikel->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Get article by ID and verify ownership
     *
     * @param int $id
     * @param User $user
     * @return Artikel|null
     */
    public function getByIdForUser(int $id, User $user): ?Artikel
    {
        return Artikel::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
    }

    /**
     * Delete article
     *
     * @param Artikel $artikel
     * @return bool
     * @throws \Exception
     */
    public function delete(Artikel $artikel): bool
    {
        return DB::transaction(function () use ($artikel) {
            try {
                // Delete associated images
                $this->deleteArticleImages($artikel);

                $artikel->delete();

                Log::info('Article deleted', [
                    'artikel_id' => $artikel->id,
                    'user_id' => $artikel->user_id,
                ]);

                return true;
            } catch (\Exception $e) {
                Log::error('Failed to delete article', [
                    'artikel_id' => $artikel->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Process and save article image using ImageService
     *
     * Uploads image to storage/app/uploads/articles/{article_id}/
     * Compresses to WebP format automatically
     *
     * @param Artikel $artikel
     * @param \Illuminate\Http\UploadedFile $file
     * @return string Path to saved image (relative to storage disk)
     * @throws \Exception
     */
    public function processArticleImage(Artikel $artikel, \Illuminate\Http\UploadedFile $file): string
    {
        try {
            // Process image using ImageService
            // Format: articles/{article_id}
            $imagePath = $this->imageService->processUpload($file, "articles/{$artikel->id}");

            if (!$imagePath) {
                throw new \Exception('Image processing failed');
            }

            Log::info('Article image processed', [
                'artikel_id' => $artikel->id,
                'image_path' => $imagePath,
            ]);

            return $imagePath;
        } catch (\Throwable $e) {
            Log::error('Failed to process article image', [
                'artikel_id' => $artikel->id,
                'error' => $e->getMessage(),
            ]);
            throw new \Exception('Gagal memproses gambar: ' . $e->getMessage());
        }
    }

    /**
     * Delete all images associated with article
     *
     * Removes article folder from storage/app/uploads/articles/{article_id}/
     * Also deletes featured image if exists
     *
     * @param Artikel $artikel
     * @return void
     */
    public function deleteArticleImages(Artikel $artikel): void
    {
        try {
            // Delete featured image if exists
            if (!empty($artikel->path_gambar)) {
                $this->imageService->deleteFile($artikel->path_gambar);
            }

            // Delete entire article images directory
            $articleImagePath = "uploads/articles/{$artikel->id}";
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($articleImagePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->deleteDirectory($articleImagePath);
                Log::info('Article images directory deleted', [
                    'artikel_id' => $artikel->id,
                    'path' => $articleImagePath,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to cleanup article images', [
                'artikel_id' => $artikel->id,
                'error' => $e->getMessage(),
            ]);
            // Don't throw - cleanup failure shouldn't block article deletion
        }
    }
}
