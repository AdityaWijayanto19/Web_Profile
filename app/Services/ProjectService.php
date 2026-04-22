<?php

namespace App\Services;

use App\Models\Proyek;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    private ImageService $imageService;

    private const PER_PAGE = 6;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): LengthAwarePaginator
    {
        return Proyek::with('teknologis')
            ->ordered()
            ->paginate(self::PER_PAGE);
    }

    public function getPublished(int $perPage = 12): LengthAwarePaginator
    {
        return Proyek::with('teknologis')
            ->published()
            ->ordered()
            ->paginate($perPage);
    }

    public function getPublishedAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Proyek::with('teknologis')
            ->published()
            ->ordered()
            ->get();
    }

    public function create(array $data): Proyek
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('ProjectService create called', [
                    'has_gambar' => isset($data['gambar']),
                    'gambar_type' => isset($data['gambar']) ? get_class($data['gambar']) : null,
                ]);

                $technologies = $data['teknologis'] ?? [];
                unset($data['teknologis']);

                if (isset($data['gambar']) && $data['gambar']) {
                    $imagePath = $this->imageService->processUpload($data['gambar'], 'projects');

                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                }

                $project = Proyek::create($data);

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

    public function update(Proyek $project, array $data): Proyek
    {
        return DB::transaction(function () use ($project, $data) {
            try {
                $technologies = $data['teknologis'] ?? [];
                unset($data['teknologis']);

                if (isset($data['gambar']) && $data['gambar']) {
                    $this->imageService->deleteProjectImages($project->path_gambar);

                    $imagePath = $this->imageService->processUpload($data['gambar'], 'projects');
                    if ($imagePath) {
                        $data['path_gambar'] = $imagePath;
                    }
                    unset($data['gambar']);
                }

                $project->update($data);

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

    public function delete(Proyek $project): bool
    {
        return DB::transaction(function () use ($project) {
            try {
                $projectData = [
                    'id' => $project->id,
                    'judul' => $project->judul,
                ];

                $this->imageService->deleteProjectImages($project->path_gambar);

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

    public function findById(int|string $id): ?Proyek
    {
        return Proyek::with('teknologis')->find($id);
    }

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
