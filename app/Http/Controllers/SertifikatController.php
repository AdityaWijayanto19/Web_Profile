<?php

namespace App\Http\Controllers;

use App\Http\Requests\SertifikatRequest;
use App\Models\Sertifikat;
use App\Services\SertifikatService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SertifikatController extends Controller
{
    /**
     * Sertifikat service instance
     */
    private SertifikatService $sertifikatService;

    /**
     * Inject dependencies
     */
    public function __construct(SertifikatService $sertifikatService)
    {
        $this->sertifikatService = $sertifikatService;
    }

    /**
     * Display index of sertifikats
     */
    public function index(): View
    {
        $sertifikats = $this->sertifikatService->index();
        return view('admin.sertifikat.index', compact('sertifikats'));
    }

    /**
     * Show create sertifikat form
     */
    public function create(): View
    {
        return view('admin.sertifikat.create');
    }

    /**
     * Store sertifikat to database
     */
    public function store(SertifikatRequest $request): RedirectResponse
    {
        try {
            $sertifikat = $this->sertifikatService->create(
                array_merge(
                    $request->validated(),
                    $request->hasFile('path_gambar') ? ['gambar' => $request->file('path_gambar')] : [],
                    ['tahun' => $request->validated()['start_year'] . ' - ' . $request->validated()['end_year']]
                )
            );

            return redirect()
                ->route('sertifikats.index', $sertifikat)
                ->with('success', 'Sertifikat berhasil dibuat!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal membuat sertifikat. Silakan coba lagi.');
        }
    }

    /**
     * Show sertifikat detail
     */
    public function show(Sertifikat $sertifikat): View
    {
        $sertifikat = $this->sertifikatService->show($sertifikat);
        return view('admin.sertifikat.show', compact('sertifikat'));
    }

    /**
     * Show edit sertifikat form
     */
    public function edit(Sertifikat $sertifikat): View
    {
        return view('admin.sertifikat.edit', compact('sertifikat'));
    }

    /**
     * Update sertifikat
     */
    public function update(SertifikatRequest $request, Sertifikat $sertifikat): RedirectResponse
    {
        try {
            $this->sertifikatService->update(
                $sertifikat,
                array_merge(
                    $request->validated(),
                    $request->hasFile('path_gambar') ? ['gambar' => $request->file('path_gambar')] : [],
                    ['tahun' => $request->validated()['start_year'] . ' - ' . $request->validated()['end_year']]
                )
            );

            return redirect()
                ->route('sertifikats.index', $sertifikat)
                ->with('success', 'Sertifikat berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui sertifikat. Silakan coba lagi.');
        }
    }

    /**
     * Delete sertifikat
     */
    public function destroy(Sertifikat $sertifikat): RedirectResponse
    {
        try {
            $this->sertifikatService->delete($sertifikat);

            return redirect()
                ->route('sertifikats.index')
                ->with('success', 'Sertifikat berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus sertifikat. Silakan coba lagi.');
        }
    }

    /**
     * Search sertifikat
     */
    public function search(Request $request): View
    {
        $query = $request->input('q', '');
        $sertifikats = $query ? $this->sertifikatService->search($query) : collect();
        return view('admin.sertifikat.index', compact('sertifikats', 'query'));
    }

    /**
     * Filter sertifikat by year
     */
    public function filterByTahun(Request $request): View
    {
        $tahun = $request->input('tahun');
        $sertifikats = $tahun ? $this->sertifikatService->filterByTahun($tahun) : $this->sertifikatService->index();
        return view('admin.sertifikat.index', compact('sertifikats', 'tahun'));
    }

    /**
     * Handle drag-and-drop reordering of sertifikats
     */
    public function reorder(\Illuminate\Http\Request $request)
    {
        try {
            $data = $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'required|integer|exists:sertifikats,id'
            ]);

            // Use database transaction for data integrity
            return \DB::transaction(function () use ($data) {
                $orderedIds = $data['ids'];

                // Get all sertifikats to understand the urutan range being dragged
                $draggedSertifikats = Sertifikat::whereIn('id', $orderedIds)
                    ->orderBy('urutan')
                    ->get();

                // Get the Min and Max urutan from dragged items to understand page context
                $minUrutan = $draggedSertifikats->min('urutan');
                $maxUrutan = $draggedSertifikats->max('urutan');

                // Assign urutan based on current position in drag list, maintaining their range
                $startUrutan = $minUrutan;
                foreach ($orderedIds as $id) {
                    Sertifikat::where('id', $id)
                        ->update(['urutan' => $startUrutan]);
                    $startUrutan++;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Urutan sertifikat berhasil diperbarui',
                    'redirect' => route('sertifikats.index')
                ]);
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Sertifikat reorder error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui urutan sertifikat'
            ], 500);
        }
    }
}
