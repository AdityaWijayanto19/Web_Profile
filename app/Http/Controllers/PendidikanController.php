<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendidikanRequest;
use App\Http\Requests\StorePendidikanRequest;
use App\Models\Pendidikan;
use App\Services\PendidikanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PendidikanController extends Controller
{
    /**
     * Inject PendidikanService
     */
    private PendidikanService $pendidikanService;

    public function __construct(PendidikanService $pendidikanService)
    {
        $this->pendidikanService = $pendidikanService;
    }

    /**
     * Show pendidikan management page
     *
     * @return View
     */
    public function index(): View
    {
        $pendidikans = $this->pendidikanService->getAll();

        return view('admin.edukasi.index', [
            'pendidikans' => $pendidikans,
        ]);
    }

    /**
     * Show create form
     *
     * @return View
     */
    public function create(): View
    {
        $newOrder = $this->pendidikanService->getNextUrutan();
        return view('admin.edukasi.create', compact('newOrder'));
    }

    /**
     * Store new pendidikan
     *
     * @param StorePendidikanRequest $request
     * @return RedirectResponse
     */
    public function store(StorePendidikanRequest $request): RedirectResponse
    {
        try {

            $this->pendidikanService->create($request->toModelData());

            return redirect()->route('pendidikans.index')
                ->with('success', 'Pendidikan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menambahkan pendidikan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Show edit form
     *
     * @param Pendidikan $pendidikan
     * @return View
     */
    public function edit(Pendidikan $pendidikan): View
    {
        return view('admin.edukasi.edit', [
            'pendidikan' => $pendidikan,
        ]);
    }

    /**
     * Update pendidikan
     *
     * @param StorePendidikanRequest $request
     * @param Pendidikan $pendidikan
     * @return RedirectResponse
     */
    public function update(StorePendidikanRequest $request, Pendidikan $pendidikan): RedirectResponse
    {
        try {
            $this->pendidikanService->update($pendidikan, $request->toModelData());

            return redirect()->route('pendidikans.index')
                ->with('success', 'Pendidikan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal memperbarui pendidikan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Delete pendidikan
     *
     * @param Pendidikan $pendidikan
     * @return RedirectResponse
     */
    public function destroy(Pendidikan $pendidikan): RedirectResponse
    {
        try {
            $this->pendidikanService->delete($pendidikan);

            return redirect()->route('pendidikans.index')
                ->with('success', 'Pendidikan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus pendidikan. Silakan coba lagi.');
        }
    }

    /**
     * Reorder pendidikan via AJAX
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function reorder(\Illuminate\Http\Request $request): JsonResponse
    {
        try {
            // Validate input
            $validated = $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'required|integer|exists:pendidikans,id'
            ]);

            // Get updated records with new urutan values
            $updatedPendidikans = $this->pendidikanService->reorder($validated['ids']);

            return response()->json([
                'success' => true,
                'message' => 'Urutan edukasi berhasil diperbarui',
                'data' => $updatedPendidikans->map(fn($p) => [
                    'id' => $p->id,
                    'urutan' => $p->urutan
                ])
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('Pendidikan reorder error: ' . $errorMsg, [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui urutan edukasi: ' . $errorMsg
            ], 500);
        }
    }
}
