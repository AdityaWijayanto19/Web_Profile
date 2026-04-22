<?php

namespace App\Services;

use App\Models\Sertifikat;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SertifikatService
{
    private ImageService $imageService;

    private const PER_PAGE = 6;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): LengthAwarePaginator
    {
        return Sertifikat::ordered()
            ->paginate(self::PER_PAGE);
    }

    public function getAll()
    {
        return Sertifikat::ordered()
            ->get();
    }

    public function create(array $data): Sertifikat
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('SertifikatService create called', [
                    'nama_sertifikat' => $data['nama_sertifikat'] ?? null,
                    'has_gambar' => isset($data['gambar']),
                ]);

                if (isset($data['gambar']) && $data['gambar']) {
                    $imagePath = $this->imageService->processUpload($data['gambar'], 'sertifikats');

                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                }

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

    public function show(Sertifikat $sertifikat): Sertifikat
    {
        return $sertifikat;
    }

    public function update(Sertifikat $sertifikat, array $data): Sertifikat
    {
        return DB::transaction(function () use ($sertifikat, $data) {
            try {
                Log::info('SertifikatService update called', [
                    'id' => $sertifikat->id,
                    'has_gambar' => isset($data['gambar']),
                ]);

                if (isset($data['gambar']) && $data['gambar']) {
                    if ($sertifikat->path_gambar) {
                        $this->imageService->deleteFile($sertifikat->path_gambar);
                    }

                    $imagePath = $this->imageService->processUpload($data['gambar'], 'sertifikats');
                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                } else {
                    unset($data['gambar']);
                }

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

    public function delete(Sertifikat $sertifikat): bool
    {
        return DB::transaction(function () use ($sertifikat) {
            try {
                Log::info('SertifikatService delete called', [
                    'id' => $sertifikat->id,
                    'nama_sertifikat' => $sertifikat->nama_sertifikat,
                ]);

                if ($sertifikat->path_gambar) {
                    $this->imageService->deleteFile($sertifikat->path_gambar);
                }

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

    public function search(string $query): LengthAwarePaginator
    {
        return Sertifikat::where('nama_sertifikat', 'like', "%{$query}%")
            ->orWhere('penerbit', 'like', "%{$query}%")
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public function filterByTahun(int $tahun): LengthAwarePaginator
    {
        return Sertifikat::where('tahun', $tahun)
            ->orderBy('nama_sertifikat', 'asc')
            ->paginate(self::PER_PAGE);
    }
}
