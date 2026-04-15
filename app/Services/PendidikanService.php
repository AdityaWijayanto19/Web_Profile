<?php

namespace App\Services;

use App\Models\Pendidikan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Length;

class PendidikanService
{

    private const PER_PAGE = 5;

    /**
     * Get all pendidikan ordered by urutan
     *
     * @return Collection
     */
    public function getAll(): LengthAwarePaginator
    {
        return Pendidikan::orderBy('urutan', 'asc')->paginate($this::PER_PAGE);
    }

    /**
     * Get pendidikan by ID
     *
     * @param int $id
     * @return Pendidikan|null
     */
    public function getById(int $id): ?Pendidikan
    {
        return Pendidikan::find($id);
    }

    /**
     * Create new pendidikan
     *
     * @param array $data
     * @return Pendidikan
     * @throws \Exception
     */
    public function create(array $data): Pendidikan
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('PendidikanService create called', [
                    'gelar' => $data['gelar'] ?? null,
                ]);

                // Get next urutan order
                $maxUrutan = Pendidikan::max('urutan') ?? 0;
                $data['urutan'] = $data['urutan'] ?? $maxUrutan + 1;

                $pendidikan = Pendidikan::create($data);

                Log::info('Pendidikan created', [
                    'id' => $pendidikan->id,
                    'gelar' => $pendidikan->gelar,
                ]);

                return $pendidikan;
            } catch (\Exception $e) {
                Log::error('Failed to create pendidikan', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Update pendidikan
     *
     * @param Pendidikan $pendidikan
     * @param array $data
     * @return Pendidikan
     * @throws \Exception
     */
    public function update(Pendidikan $pendidikan, array $data): Pendidikan
    {
        return DB::transaction(function () use ($pendidikan, $data) {
            try {
                Log::info('PendidikanService update called', [
                    'id' => $pendidikan->id,
                    'gelar' => $data['gelar'] ?? null,
                ]);

                $pendidikan->update($data);

                Log::info('Pendidikan updated', [
                    'id' => $pendidikan->id,
                    'gelar' => $pendidikan->gelar,
                ]);

                return $pendidikan;
            } catch (\Exception $e) {
                Log::error('Failed to update pendidikan', [
                    'id' => $pendidikan->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Delete pendidikan
     *
     * @param Pendidikan $pendidikan
     * @return bool
     * @throws \Exception
     */
    public function delete(Pendidikan $pendidikan): bool
    {
        return DB::transaction(function () use ($pendidikan) {
            try {
                Log::info('PendidikanService delete called', [
                    'id' => $pendidikan->id,
                    'gelar' => $pendidikan->gelar,
                ]);

                $deleted = $pendidikan->delete();

                Log::info('Pendidikan deleted', [
                    'id' => $pendidikan->id,
                    'success' => $deleted,
                ]);

                return $deleted;
            } catch (\Exception $e) {
                Log::error('Failed to delete pendidikan', [
                    'id' => $pendidikan->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Search pendidikan by gelar or instansi
     *
     * @param string $query
     * @return Collection
     */
    public function search(string $query): Collection
    {
        return Pendidikan::where('gelar', 'like', "%{$query}%")
            ->orWhere('instansi', 'like', "%{$query}%")
            ->ordered()
            ->get();
    }

    /**
     * Reorder pendidikan based on new sequence
     *
     * @param array $ids Array of IDs in new order
     * @return Collection
     * @throws \Exception
     */
    public function reorder(array $ids): Collection
    {
        return DB::transaction(function () use ($ids) {
            try {
                if (empty($ids)) {
                    throw new \Exception('IDs array cannot be empty');
                }

                $orderedIds = $ids;

                // Get pendidikan records being dragged to understand urutan range
                $draggedPendidikans = Pendidikan::whereIn('id', $orderedIds)
                    ->orderBy('urutan')
                    ->get();

                if ($draggedPendidikans->isEmpty()) {
                    throw new \Exception('No pendidikan found for reordering');
                }

                // Get the Min and Max urutan from dragged items to understand page context
                $minUrutan = $draggedPendidikans->min('urutan') ?? 1;
                $maxUrutan = $draggedPendidikans->max('urutan') ?? count($ids);

                // Assign urutan based on current position in drag list, maintaining their range
                $startUrutan = $minUrutan;
                foreach ($orderedIds as $id) {
                    Pendidikan::where('id', $id)
                        ->update(['urutan' => $startUrutan]);
                    $startUrutan++;
                }

                Log::info('Pendidikan reordered', [
                    'count' => count($ids),
                    'range' => "$minUrutan - $maxUrutan",
                ]);

                // Return the reordered records as a collection
                return Pendidikan::whereIn('id', $orderedIds)
                    ->orderBy('urutan')
                    ->get();
            } catch (\Exception $e) {
                Log::error('Failed to reorder pendidikan', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Get count of pendidikan
     *
     * @return int
     */
    public function count(): int
    {
        return Pendidikan::count();
    }
}
