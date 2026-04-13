<?php

namespace App\Services;

use App\Models\Proyek;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    /**
     * ImageService instance for image processing
     */
    private ImageService $imageService;

    /**
     * Perpage items for pagination
     */
    private const PER_PAGE = 12;

    /**
     * Inject dependencies
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Get paginated projects list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Proyek::with('teknologis')
            ->ordered()
            ->paginate(self::PER_PAGE);
    }

    /**
     * Get published projects (for frontend)
     *
     * @return LengthAwarePaginator
     */
    public function getPublished(int $perPage = 12): LengthAwarePaginator
    {
        return Proyek::with('teknologis')
            ->published()
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * Create new project with image processing
     *
     * @param array $data
     * @return Proyek
     * @throws \Exception
     */
    public function create(array $data): Proyek
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('ProjectService create called', [
                    'has_gambar' => isset($data['gambar']),
                    'gambar_type' => isset($data['gambar']) ? get_class($data['gambar']) : null,
                ]);

                // Ambil teknologi dari array
                $technologies = $data['teknologis'] ?? [];
                unset($data['teknologis']);

                // Process image jika ada
                if (isset($data['gambar']) && $data['gambar']) {
                    $imagePath = $this->imageService->processUpload($data['gambar'], 'projects');

                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                }

                // Create project
                $project = Proyek::create($data);

                // Attach technologies
                if (!empty($technologies)) {
                    $project->teknologis()->attach($technologies);
                }

                Log::info('Project created', [
                    'id' => $project->id,
                    'judul' => $project->judul,
                    'technologies_count' => count($technologies),
                    'path_gambar' => $project->path_gambar,
                ]);

                return $project;
            } catch (\Exception $e) {
                Log::error('Failed to create project', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Update existing project with image processing
     *
     * @param Proyek $project
     * @param array $data
     * @return Proyek
     * @throws \Exception
     */
    public function update(Proyek $project, array $data): Proyek
    {
        return DB::transaction(function () use ($project, $data) {
            try {
                // Ambil teknologi dari array
                $technologies = $data['teknologis'] ?? [];
                unset($data['teknologis']);

                // Process image jika ada upload baru
                if (isset($data['gambar']) && $data['gambar']) {
                    // Delete old image
                    $this->imageService->deleteProjectImages($project->path_gambar);

                    // Process new image
                    $imagePath = $this->imageService->processUpload($data['gambar'], 'projects');
                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                }

                // Update project
                $project->update($data);

                // Sync technologies
                if (!empty($technologies)) {
                    $project->teknologis()->sync($technologies);
                } else {
                    $project->teknologis()->detach();
                }

                Log::info('Project updated', [
                    'id' => $project->id,
                    'judul' => $project->judul,
                    'technologies_count' => count($technologies),
                ]);

                return $project;
            } catch (\Exception $e) {
                Log::error('Failed to update project', [
                    'id' => $project->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Delete project with cascading relationships
     *
     * @param Proyek $project
     * @return bool
     * @throws \Exception
     */
    public function delete(Proyek $project): bool
    {
        return DB::transaction(function () use ($project) {
            try {
                $projectData = [
                    'id' => $project->id,
                    'judul' => $project->judul,
                ];

                // Delete project images
                $this->imageService->deleteProjectImages($project->path_gambar);

                // Delete project (cascading delete for technologies via pivot)
                $deleted = $project->delete();

                Log::info('Project deleted', $projectData);

                return $deleted;
            } catch (\Exception $e) {
                Log::error('Failed to delete project', [
                    'id' => $project->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Get project by ID with eager loading
     *
     * @param int|string $id
     * @return Proyek|null
     */
    public function findById(int|string $id): ?Proyek
    {
        return Proyek::with('teknologis')->find($id);
    }

    /**
     * Get project statistics
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'total' => Proyek::count(),
            'published' => Proyek::published()->count(),
            'draft' => Proyek::draft()->count(),
            'with_most_technologies' => Proyek::withCount('teknologis')
                ->orderByDesc('teknologis_count')
                ->first(['id', 'judul']),
        ];
    }
}
