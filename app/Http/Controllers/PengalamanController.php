<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengalamanRequest;
use App\Services\PengalamanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengalamanController extends Controller
{
    /**
     * Inject PengalamanService
     */
    private PengalamanService $pengalamanService;

    public function __construct(PengalamanService $pengalamanService)
    {
        $this->pengalamanService = $pengalamanService;
    }

    /**
     * Show pengalaman management page
     *
     * @return View
     */
    public function index(): View
    {
        $pengalamans = $this->pengalamanService->getAll();

        return view('admin.pengalaman', [
            'pengalamans' => $pengalamans,
        ]);
    }

    /**
     * Update pengalaman (batch update with reordering)
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function update(\Illuminate\Http\Request $request): RedirectResponse
    {
        try {
            $pengalamans = $request->input('pengalamans', []);

            foreach ($pengalamans as $id => $data) {
                $pengalaman = $this->pengalamanService->getById($id);
                if ($pengalaman) {
                    $this->pengalamanService->update($pengalaman, $data);
                }
            }

            return back()->with('success', 'Pengalaman berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal memperbarui pengalaman. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Reorder pengalaman via AJAX
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reorder(\Illuminate\Http\Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            $this->pengalamanService->reorder($ids);

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder pengalaman',
            ], 500);
        }
    }
}
