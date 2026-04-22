<?php

namespace App\Services;

use App\Models\Footer;
use App\Models\FooterMediaSozial;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class FooterService
{
    /**
     * Get footer utama (untuk landing page)
     *
     * @return Footer|null
     */
    public function getMain(): ?Footer
    {
        return Footer::with('mediaSozials.technology')
            ->orderBy('urutan', 'asc')
            ->first();
    }

    /**
     * Get semua footer
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Footer::with('mediaSozials.technology')
            ->orderBy('urutan', 'asc')
            ->get();
    }

    /**
     * Get footer berdasarkan ID
     *
     * @param int $id
     * @return Footer|null
     */
    public function getById(int $id): ?Footer
    {
        return Footer::with('mediaSozials.technology')->find($id);
    }

    /**
     * Create footer baru
     *
     * @param array $data
     * @return Footer
     */
    public function create(array $data): Footer
    {
        return DB::transaction(function () use ($data) {
            try {
                Log::info('FooterService create called', [
                    'nama_web' => $data['nama_web'] ?? null,
                ]);

                $mediaSozials = $data['media_sozials'] ?? [];
                unset($data['media_sozials']);

                $maxUrutan = Footer::max('urutan') ?? 0;
                $data['urutan'] = $data['urutan'] ?? $maxUrutan + 1;

                $footer = Footer::create($data);

                if (!empty($mediaSozials)) {
                    $this->attachMediaSozials($footer, $mediaSozials);
                }

                Log::info('Footer created', [
                    'id' => $footer->id,
                    'nama_web' => $footer->nama_web,
                ]);

                return $footer->load('mediaSozials.technology');
            } catch (\Exception $e) {
                Log::error('Failed to create footer', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Update footer
     *
     * @param Footer $footer
     * @param array $data
     * @return Footer
     */
    public function update(Footer $footer, array $data): Footer
    {
        return DB::transaction(function () use ($footer, $data) {
            try {
                Log::info('FooterService update called', [
                    'id' => $footer->id,
                    'nama_web' => $data['nama_web'] ?? null,
                ]);

                $mediaSozials = $data['media_sozials'] ?? [];
                unset($data['media_sozials']);

                $footer->update($data);

                if (array_key_exists('media_sozials', $data) || !empty($mediaSozials)) {
                    $footer->mediaSozials()->delete();
                    if (!empty($mediaSozials)) {
                        $this->attachMediaSozials($footer, $mediaSozials);
                    }
                }

                Log::info('Footer updated', [
                    'id' => $footer->id,
                    'nama_web' => $footer->nama_web,
                ]);

                return $footer->load('mediaSozials.technology');
            } catch (\Exception $e) {
                Log::error('Failed to update footer', [
                    'id' => $footer->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Delete footer
     *
     * @param Footer $footer
     * @return bool
     */
    public function delete(Footer $footer): bool
    {
        return DB::transaction(function () use ($footer) {
            try {
                Log::info('FooterService delete called', [
                    'id' => $footer->id,
                    'nama_web' => $footer->nama_web,
                ]);

                $deleted = $footer->delete();

                Log::info('Footer deleted', [
                    'id' => $footer->id,
                ]);

                return $deleted;
            } catch (\Exception $e) {
                Log::error('Failed to delete footer', [
                    'id' => $footer->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw $e;
            }
        });
    }

    /**
     * Attach media sozials ke footer
     *
     * @param Footer $footer
     * @param array $mediaSozials
     * @return void
     */
    private function attachMediaSozials(Footer $footer, array $mediaSozials): void
    {
        foreach ($mediaSozials as $index => $media) {
            FooterMediaSozial::create([
                'footer_id' => $footer->id,
                'technology_id' => $media['technology_id'] ?? null,
                'url' => $media['url'] ?? '',
                'urutan' => $media['urutan'] ?? $index,
            ]);
        }
    }
}
