<?php

namespace App\Http\Controllers;

use App\Http\Requests\FooterRequest;
use App\Models\Footer;
use App\Services\FooterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FooterController extends Controller
{
    /**
     * Inject dependencies
     */
    public function __construct(
        private FooterService $footerService,
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
        $technologies = $this->footerService->getTechnologies();

        return view('admin.footer.create', compact('technologies'));
    }

    /**
     * Store footer in database
     */
    public function store(FooterRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('logo_path')) {
                $logoPath = $this->footerService->processLogoUpload(
                    $request->file('logo_path')
                );
                if ($logoPath) {
                    $data['logo_path'] = $logoPath;
                }
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
        $technologies = $this->footerService->getTechnologies();
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

            if ($request->hasFile('logo_path')) {
                $this->footerService->deleteLogoIfExists($footer);

                $logoPath = $this->footerService->processLogoUpload(
                    $request->file('logo_path')
                );
                if ($logoPath) {
                    $data['logo_path'] = $logoPath;
                }
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
            $this->footerService->deleteLogoIfExists($footer);
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

