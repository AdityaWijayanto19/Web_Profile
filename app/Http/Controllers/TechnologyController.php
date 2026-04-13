<?php

namespace App\Http\Controllers;

use App\Models\Teknologi;
use App\Services\TechnologyService;
use App\Http\Requests\TechnologyRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TechnologyController extends Controller
{
    /**
     * Technology service instance
     */
    private TechnologyService $technologyService;

    /**
     * Inject dependencies
     */
    public function __construct(TechnologyService $technologyService)
    {
        $this->technologyService = $technologyService;
    }

    /**
     * Display list of technologies
     */
    public function index(): View
    {
        $technologies = $this->technologyService->index();
        return view('admin.technology.index', compact('technologies'));
    }

    /**
     * Show create technology form
     */
    public function create(): View
    {
        return view('admin.technology.create');
    }

    /**
     * Store technology in database
     */
    public function store(TechnologyRequest $request): RedirectResponse
    {
        try {
            $this->technologyService->create(
                $request->validated()
            );

            return redirect()
                ->route('technologies.index')
                ->with('success', 'Teknologi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan teknologi. Silakan coba lagi.');
        }
    }

    /**
     * Show edit technology form
     */
    public function edit(Teknologi $technology): View
    {
        return view('admin.technology.edit', compact('technology'));
    }

    /**
     * Update technology
     */
    public function update(TechnologyRequest $request, Teknologi $technology): RedirectResponse
    {
        try {
            $this->technologyService->update(
                $technology,
                $request->validated()
            );

            return redirect()
                ->route('technologies.index')
                ->with('success', 'Teknologi berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui teknologi. Silakan coba lagi.');
        }
    }

    /**
     * Delete technology
     */
    public function destroy(Teknologi $technology): RedirectResponse
    {
        try {
            $this->technologyService->delete($technology);

            return redirect()
                ->route('technologies.index')
                ->with('success', 'Teknologi berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus teknologi. Silakan coba lagi.');
        }
    }
}
