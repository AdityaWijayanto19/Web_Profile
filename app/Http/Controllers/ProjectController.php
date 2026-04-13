<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Proyek;
use App\Models\Teknologi;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Project service instance
     */
    private ProjectService $projectService;

    /**
     * Inject dependencies
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display index of projects
     */
    public function index(): View
    {
        $proyeks = $this->projectService->index();
        return view('admin.project.index', compact('proyeks'));
    }

    /**
     * Show create project form
     */
    public function create(): View
    {
        $teknologis = Teknologi::ordered()->get();
        return view('admin.project.create', compact('teknologis'));
    }

    /**
     * Store project to database
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        try {
            $proyek = $this->projectService->create(
                array_merge(
                    $request->validated(),
                    $request->hasFile('gambar') ? ['gambar' => $request->file('gambar')] : []
                )
            );

            return redirect()
                ->route('projects.show', $proyek)
                ->with('success', 'Proyek berhasil dibuat!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal membuat proyek. Silakan coba lagi.');
        }
    }

    /**
     * Show project detail
     */
    public function show(Proyek $proyek): View
    {
        $proyek->load('teknologis');

        return view('admin.project.show', ['proyek' => $proyek]);
    }

    /**
     * Show edit project form
     */
    public function edit(Proyek $proyek): View
    {
        $teknologis = Teknologi::ordered()->get();
        $selectedTeknologis = $proyek->teknologis()->pluck('teknologis.id')->toArray();

        return view('admin.project.edit', compact('proyek', 'teknologis', 'selectedTeknologis'));
    }

    /**
     * Update project
     */
    public function update(ProjectRequest $request, Proyek $proyek): RedirectResponse
    {
        try {
            $this->projectService->update(
                $proyek,
                array_merge(
                    $request->validated(),
                    $request->hasFile('gambar') ? ['gambar' => $request->file('gambar')] : []
                )
            );

            return redirect()
                ->route('projects.show', $proyek)
                ->with('success', 'Proyek berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui proyek. Silakan coba lagi.');
        }
    }

    /**
     * Delete project
     */
    public function destroy(Proyek $proyek): RedirectResponse
    {
        try {
            $this->projectService->delete($proyek);

            return redirect()
                ->route('projects.index')
                ->with('success', 'Proyek berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus proyek. Silakan coba lagi.');
        }
    }

    /**
     * Handle drag-and-drop reordering of projects
     */
    public function reorder(\Illuminate\Http\Request $request)
    {
        try {
            $orders = $request->validate([
                'orders' => 'required|array',
                'orders.*.id' => 'required|integer|exists:proyeks,id',
                'orders.*.position' => 'required|integer|min:1'
            ]);

            // Use database transaction for data integrity
            return \DB::transaction(function () use ($orders) {
                foreach ($orders['orders'] as $order) {
                    Proyek::where('id', $order['id'])
                        ->update(['urutan' => $order['position']]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Urutan proyek berhasil diperbarui'
                ]);
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Project reorder error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui urutan proyek'
            ], 500);
        }
    }
}
