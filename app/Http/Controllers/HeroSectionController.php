<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeroSectionRequest;
use App\Models\HeroSection;
use App\Services\HeroSectionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HeroSectionController extends Controller
{
    /**
     * HeroSection service instance
     */
    private HeroSectionService $heroSectionService;

    /**
     * Inject dependencies
     */
    public function __construct(HeroSectionService $heroSectionService)
    {
        $this->heroSectionService = $heroSectionService;
    }

    /**
     * Show hero section edit form
     * (Hero section is singleton - only one exists)
     */
    public function edit(): View
    {
        $hero = $this->heroSectionService->getHero();
        return view('admin.profile', compact('hero'));
    }

    /**
     * Update hero section
     */
    public function update(HeroSectionRequest $request): RedirectResponse
    {
        try {
            $this->heroSectionService->upsert($request->validated());

            return back()
                ->with('success', 'Hero section berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui hero section. Silakan coba lagi.');
        }
    }

    /**
     * Delete hero section image
     */
    public function deleteImage(): RedirectResponse
    {
        try {
            $hero = $this->heroSectionService->getHero();

            if (!$hero) {
                return back()->with('error', 'Hero section tidak ditemukan.');
            }

            if ($hero->path_foto) {
                $this->heroSectionService->deleteImage($hero->path_foto);
                $hero->update(['path_foto' => null]);
            }

            return back()
                ->with('success', 'Gambar berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus gambar. Silakan coba lagi.');
        }
    }
}
