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

    public function getAll(): LengthAwarePaginator
    {
        return Pendidikan::orderBy('urutan', 'asc')->paginate($this::PER_PAGE);
    }

    public function getForLanding(int $limit = 2): Collection
    {
        return Pendidikan::orderBy('urutan', 'asc')->limit($limit)->get();
    }

    public function getById(int $id): ?Pendidikan
    {
        return Pendidikan::find($id);
    }

    public function create(array $data): Pendidikan
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('PendidikanService create called', [
                    'gelar' => $data['gelar'] ?? null,
                ]);

                $data['urutan'] = Pendidikan::getNextUrutan();

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

    public function search(string $query): Collection
    {
        return Pendidikan::where('gelar', 'like', "%{$query}%")
            ->orWhere('instansi', 'like', "%{$query}%")
            ->ordered()
            ->get();
    }

    public function reorder(array $ids): Collection
    {
        return DB::transaction(function () use ($ids) {
            try {
                if (empty($ids)) {
                    throw new \Exception('IDs array cannot be empty');
                }

                $orderedIds = $ids;

                $draggedPendidikans = Pendidikan::whereIn('id', $orderedIds)
                    ->orderBy('urutan')
                    ->get();

                if ($draggedPendidikans->isEmpty()) {
                    throw new \Exception('No pendidikan found for reordering');
                }

                $minUrutan = $draggedPendidikans->min('urutan') ?? 1;
                $maxUrutan = $draggedPendidikans->max('urutan') ?? count($ids);

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

    public function count(): int
    {
        return Pendidikan::count();
    }

    public function getNextUrutan(): int
    {
        return Pendidikan::getNextUrutan();
    }
}
