<?php

namespace App\Services;

use App\Models\Teknologi;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class TechnologyService
{
    /**
     * Perpage items for pagination
     */
    private const PER_PAGE = 15;

    /**
     * Get paginated technologies list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Teknologi::ordered()
            ->paginate(self::PER_PAGE);
    }

    /**
     * Create new technology
     *
     * @param array $data
     * @return Teknologi
     * @throws \Exception
     */
    public function create(array $data): Teknologi
    {
        try {
            $technology = Teknologi::create($data);

            Log::info('Technology created', [
                'id' => $technology->id,
                'nama' => $technology->nama,
                'path_icon' => $technology->path_icon,
            ]);

            return $technology;
        } catch (\Exception $e) {
            Log::error('Failed to create technology', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
            throw $e;
        }
    }

    /**
     * Update existing technology
     *
     * @param Teknologi $technology
     * @param array $data
     * @return Teknologi
     * @throws \Exception
     */
    public function update(Teknologi $technology, array $data): Teknologi
    {
        try {
            $oldData = $technology->only(['nama', 'path_icon']);

            $technology->update($data);

            Log::info('Technology updated', [
                'id' => $technology->id,
                'old_data' => $oldData,
                'new_data' => $data,
            ]);

            return $technology;
        } catch (\Exception $e) {
            Log::error('Failed to update technology', [
                'id' => $technology->id,
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
            throw $e;
        }
    }

    /**
     * Delete technology
     *
     * @param Teknologi $technology
     * @return bool
     * @throws \Exception
     */
    public function delete(Teknologi $technology): bool
    {
        try {
            $technologyData = [
                'id' => $technology->id,
                'nama' => $technology->nama,
                'projects_count' => $technology->proyeks()->count(),
            ];

            $deleted = $technology->delete();

            Log::info('Technology deleted', $technologyData);

            return $deleted;
        } catch (\Exception $e) {
            Log::error('Failed to delete technology', [
                'id' => $technology->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Get technology by ID with relationships
     *
     * @param int|string $id
     * @return Teknologi|null
     */
    public function findById(int|string $id): ?Teknologi
    {
        return Teknologi::with('proyeks')
            ->find($id);
    }

    /**
     * Check if technology exists
     *
     * @param string $nama
     * @return bool
     */
    public function existsByName(string $nama): bool
    {
        return Teknologi::whereName($nama)->exists();
    }

    /**
     * Get all technologies for dropdown (optimized query)
     *
     * @return Collection
     */
    public function getAllForDropdown(): Collection
    {
        return Teknologi::ordered()
            ->select('id', 'nama', 'path_icon')
            ->get();
    }

    /**
     * Get statistics about technologies
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'total' => Teknologi::count(),
            'recently_added' => Teknologi::latest()->limit(5)->pluck('nama'),
            'most_used' => $this->getMostUsedTechnologies(),
        ];
    }

    /**
     * Get most used technologies in projects
     *
     * @param int $limit
     * @return Collection
     */
    private function getMostUsedTechnologies(int $limit = 5): Collection
    {
        return Teknologi::withCount('proyeks')
            ->orderByDesc('proyeks_count')
            ->limit($limit)
            ->select('id', 'nama', 'path_icon')
            ->get();
    }
}
