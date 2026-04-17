<?php

namespace App\Services;

use App\Models\Pengalaman;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class PengalamanService
{
    public function getAll(): Collection
    {
        return Pengalaman::ordered()->get();
    }

    public function getById(int $id): ?Pengalaman
    {
        return Pengalaman::find($id);
    }

    public function batchUpdate(array $pengalamans): Collection
    {
        return DB::transaction(function () use ($pengalamans) {
            try {
                Log::info('PengalamanService batchUpdate called', [
                    'count' => count($pengalamans),
                ]);

                $updateCount = 0;

                foreach ($pengalamans as $index => $data) {
                    $pengalaman = Pengalaman::ordered()->skip($index)->first();

                    if ($pengalaman) {
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

    public function create(array $data): Pengalaman
    {
        return DB::transaction(function () use ($data) {
            try {
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
