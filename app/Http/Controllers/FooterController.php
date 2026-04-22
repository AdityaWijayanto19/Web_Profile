<?php

namespace App\Http\Controllers;

use App\Http\Requests\FooterRequest;
use App\Models\Footer;
use App\Models\Teknologi;
use App\Services\FooterService;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FooterController extends Controller
{
    /**
     * Inject dependencies
     */
    public function __construct(
        private FooterService $footerService,
        private ImageService $imageService,
    ) {
    }

    /**
     * Display list of footers
     */
    public function index(): View
    {
        $footers = $this->footerService->getAll();
        $totalMedia = $footers->sum(fn($footer) => $footer->mediaSozials->count());

        return view('admin.footer.index', compact('footers', 'totalMedia'));
    }

    /**
     * Show create form
     */
    public function create(): View
    {
        $technologies = Teknologi::orderBy('nama', 'asc')->get();

        return view('admin.footer.create', compact('technologies'));
    }

    /**
     * Store footer in database
     */
    public function store(FooterRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Handle logo upload
            if ($request->hasFile('logo_path')) {
                $logoPath = $this->imageService->uploadImage(
                    $request->file('logo_path'),
                    'footers/logos'
                );
                $data['logo_path'] = $logoPath;
            }

            $this->footerService->create($data);

            return redirect()
                ->route('admin.footer.index')
                ->with('success', 'Footer berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan footer. Silakan coba lagi.');
        }
    }

    /**
     * Show edit form
     */
    public function edit(Footer $footer): View
    {
        $technologies = Teknologi::orderBy('nama', 'asc')->get();
        $footer = $this->footerService->getById($footer->id);

        return view('admin.footer.edit', compact('footer', 'technologies'));
    }

    /**
     * Update footer in database
     */
    public function update(FooterRequest $request, Footer $footer): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Handle logo upload
            if ($request->hasFile('logo_path')) {
                // Delete old logo
                if ($footer->logo_path && Storage::disk('public')->exists($footer->logo_path)) {
                    Storage::disk('public')->delete($footer->logo_path);
                }

                $logoPath = $this->imageService->uploadImage(
                    $request->file('logo_path'),
                    'footers/logos'
                );
                $data['logo_path'] = $logoPath;
            }

            $this->footerService->update($footer, $data);

            return redirect()
                ->route('admin.footer.index')
                ->with('success', 'Footer berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui footer. Silakan coba lagi.');
        }
    }

    /**
     * Delete footer from database
     */
    public function destroy(Footer $footer): RedirectResponse
    {
        try {
            // Delete logo
            if ($footer->logo_path && Storage::disk('public')->exists($footer->logo_path)) {
                Storage::disk('public')->delete($footer->logo_path);
            }

            $this->footerService->delete($footer);

            return redirect()
                ->route('admin.footer.index')
                ->with('success', 'Footer berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus footer. Silakan coba lagi.');
        }
    }
}
