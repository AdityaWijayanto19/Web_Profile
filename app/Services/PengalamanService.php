<?php

namespace App\Services;

use App\Models\Pengalaman;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class PengalamanService
{
    /**
     * Get all pengalaman ordered by urutan
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Pengalaman::ordered()->get();
    }

    /**
     * Get pengalaman by ID
     *
     * @param int $id
     * @return Pengalaman|null
     */
    public function getById(int $id): ?Pengalaman
    {
        return Pengalaman::find($id);
    }

    /**
     * Batch update pengalaman (for reordering and editing)
     *
     * @param array $pengalamans Array of pengalaman data with ID and fields
     * @return Collection
     * @throws \Exception
     */
    public function batchUpdate(array $pengalamans): Collection
    {
        return DB::transaction(function () use ($pengalamans) {
            try {
                Log::info('PengalamanService batchUpdate called', [
                    'count' => count($pengalamans),
                ]);

                $updateCount = 0;

                foreach ($pengalamans as $index => $data) {
                    // Assume data contains ID or we get existing records
                    $pengalaman = Pengalaman::ordered()->skip($index)->first();

                    if ($pengalaman) {
                        // Update urutan and other fields
                        $pengalaman->update([
                            'jabatan' => $data['jabatan'] ?? $pengalaman->jabatan,
                            'keterangan' => $data['keterangan'] ?? $pengalaman->keterangan,
                            'urutan' => $data['urutan'] ?? $index,
                        ]);

                        $updateCount++;
                    }
                }

                Log::info('Pengalaman batch updated', [
                    'updated_count' => $updateCount,
                ]);

                return $this->getAll();
            } catch (\Exception $e) {
                Log::error('Failed to batch update pengalaman', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Create new pengalaman
     *
     * @param array $data
     * @return Pengalaman
     * @throws \Exception
     */
    public function create(array $data): Pengalaman
    {
        return DB::transaction(function () use ($data) {
            try {
                // Get next urutan order
                $maxUrutan = Pengalaman::max('urutan') ?? 0;

                $pengalaman = Pengalaman::create([
                    'jabatan' => $data['jabatan'],
                    'keterangan' => $data['keterangan'] ?? null,
                    'urutan' => $data['urutan'] ?? $maxUrutan + 1,
                ]);

                Log::info('Pengalaman created', [
                    'id' => $pengalaman->id,
                    'jabatan' => $pengalaman->jabatan,
                ]);

                return $pengalaman;
            } catch (\Exception $e) {
                Log::error('Failed to create pengalaman', [
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Update single pengalaman
     *
     * @param Pengalaman $pengalaman
     * @param array $data
     * @return Pengalaman
     * @throws \Exception
     */
    public function update(Pengalaman $pengalaman, array $data): Pengalaman
    {
        return DB::transaction(function () use ($pengalaman, $data) {
            try {
                $pengalaman->update($data);

                Log::info('Pengalaman updated', [
                    'id' => $pengalaman->id,
                    'jabatan' => $pengalaman->jabatan,
                ]);

                return $pengalaman;
            } catch (\Exception $e) {
                Log::error('Failed to update pengalaman', [
                    'id' => $pengalaman->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Delete pengalaman
     *
     * @param Pengalaman $pengalaman
     * @return bool
     * @throws \Exception
     */
    public function delete(Pengalaman $pengalaman): bool
    {
        return DB::transaction(function () use ($pengalaman) {
            try {
                $deleted = $pengalaman->delete();

                Log::info('Pengalaman deleted', [
                    'id' => $pengalaman->id,
                    'success' => $deleted,
                ]);

                return $deleted;
            } catch (\Exception $e) {
                Log::error('Failed to delete pengalaman', [
                    'id' => $pengalaman->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Reorder pengalaman based on new sequence
     *
     * @param array $ids Array of IDs in new order
     * @return Collection
     * @throws \Exception
     */
    public function reorder(array $ids): Collection
    {
        return DB::transaction(function () use ($ids) {
            try {
                foreach ($ids as $index => $id) {
                    Pengalaman::where('id', $id)->update(['urutan' => $index + 1]);
                }

                Log::info('Pengalaman reordered', [
                    'count' => count($ids),
                ]);

                return $this->getAll();
            } catch (\Exception $e) {
                Log::error('Failed to reorder pengalaman', [
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }
}
