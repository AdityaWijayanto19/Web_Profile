<?php

namespace App\Services;

use App\Models\Sertifikat;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SertifikatService
{
    /**
     * ImageService instance for image processing
     */
    private ImageService $imageService;

    /**
     * Perpage items for pagination
     */
    private const PER_PAGE = 6;

    /**
     * Inject dependencies
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Get paginated sertifikat list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Sertifikat::orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE);
    }

    /**
     * Get all sertifikat for frontend
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Sertifikat::orderBy('tahun', 'desc')
            ->orderBy('nama_sertifikat', 'asc')
            ->get();
    }

    /**
     * Create new sertifikat with image processing
     *
     * @param array $data
     * @return Sertifikat
     * @throws \Exception
     */
    public function create(array $data): Sertifikat
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('SertifikatService create called', [
                    'nama_sertifikat' => $data['nama_sertifikat'] ?? null,
                    'has_gambar' => isset($data['gambar']),
                ]);

                // Process image jika ada
                if (isset($data['gambar']) && $data['gambar']) {
                    $imagePath = $this->imageService->processUpload($data['gambar'], 'sertifikats');

                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                }

                // Create sertifikat
                $sertifikat = Sertifikat::create($data);

                Log::info('Sertifikat created', [
                    'id' => $sertifikat->id,
                    'nama_sertifikat' => $sertifikat->nama_sertifikat,
                    'path_gambar' => $sertifikat->path_gambar,
                ]);

                return $sertifikat;
            } catch (\Exception $e) {
                Log::error('Failed to create sertifikat', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Get single sertifikat by ID
     *
     * @param Sertifikat $sertifikat
     * @return Sertifikat
     */
    public function show(Sertifikat $sertifikat): Sertifikat
    {
        return $sertifikat;
    }

    /**
     * Update existing sertifikat with image processing
     *
     * @param Sertifikat $sertifikat
     * @param array $data
     * @return Sertifikat
     * @throws \Exception
     */
    public function update(Sertifikat $sertifikat, array $data): Sertifikat
    {
        return DB::transaction(function () use ($sertifikat, $data) {
            try {
                Log::info('SertifikatService update called', [
                    'id' => $sertifikat->id,
                    'has_gambar' => isset($data['gambar']),
                ]);

                // Process image jika ada upload baru
                if (isset($data['gambar']) && $data['gambar']) {
                    // Delete old image
                    if ($sertifikat->path_gambar) {
                        $this->imageService->deleteFile($sertifikat->path_gambar);
                    }

                    // Process new image
                    $imagePath = $this->imageService->processUpload($data['gambar'], 'sertifikats');
                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                } else {
                    unset($data['gambar']);
                }

                // Update sertifikat
                $sertifikat->update($data);

                Log::info('Sertifikat updated', [
                    'id' => $sertifikat->id,
                    'nama_sertifikat' => $sertifikat->nama_sertifikat,
                    'path_gambar' => $sertifikat->path_gambar,
                ]);

                return $sertifikat;
            } catch (\Exception $e) {
                Log::error('Failed to update sertifikat', [
                    'id' => $sertifikat->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Delete sertifikat with image cleanup
     *
     * @param Sertifikat $sertifikat
     * @return bool
     * @throws \Exception
     */
    public function delete(Sertifikat $sertifikat): bool
    {
        return DB::transaction(function () use ($sertifikat) {
            try {
                Log::info('SertifikatService delete called', [
                    'id' => $sertifikat->id,
                    'nama_sertifikat' => $sertifikat->nama_sertifikat,
                ]);

                // Delete image if exists
                if ($sertifikat->path_gambar) {
                    $this->imageService->deleteFile($sertifikat->path_gambar);
                }

                // Delete sertifikat
                $deleted = $sertifikat->delete();

                Log::info('Sertifikat deleted', [
                    'id' => $sertifikat->id,
                    'success' => $deleted,
                ]);

                return $deleted;
            } catch (\Exception $e) {
                Log::error('Failed to delete sertifikat', [
                    'id' => $sertifikat->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Search sertifikat by nama or penerbit
     *
     * @param string $query
     * @return LengthAwarePaginator
     */
    public function search(string $query): LengthAwarePaginator
    {
        return Sertifikat::where('nama_sertifikat', 'like', "%{$query}%")
            ->orWhere('penerbit', 'like', "%{$query}%")
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE);
    }

    /**
     * Filter sertifikat by year
     *
     * @param int $tahun
     * @return LengthAwarePaginator
     */
    public function filterByTahun(int $tahun): LengthAwarePaginator
    {
        return Sertifikat::where('tahun', $tahun)
            ->orderBy('nama_sertifikat', 'asc')
            ->paginate(self::PER_PAGE);
    }
}
