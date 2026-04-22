<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleImageUploadRequest;
use App\Models\Artikel;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    /**
     * Article service instance
     */
    private ArticleService $articleService;

    /**
     * Inject dependencies
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display index of articles (drafts and published)
     */
    public function index(): View
    {
        $user = auth()->user();
        $draftArticles = $this->articleService->getDrafts($user);
        $publishedArticles = $this->articleService->getPublished($user);

        return view('admin.article.index', compact('draftArticles', 'publishedArticles'));
    }

    /**
     * Create new draft article and redirect to editor
     */
    public function create(): RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->createDraft($user);

            return redirect()->route('article.edit', $artikel->id);
        } catch (\Exception $e) {
            Log::error('Failed to create draft article', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal membuat draft artikel. Silakan coba lagi.');
        }
    }

    /**
     * Show article editor (for draft and published articles)
     */
    public function edit(int $id): View|RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            // Allow editing both draft and published articles
            // Parse isi_konten JSON untuk ditampilkan di editor
            $artikelContent = json_decode($artikel->isi_konten, true) ?? ['blocks' => []];

            return view('admin.article.create', compact('artikel', 'artikelContent'));
        } catch (\Exception $e) {
            Log::error('Failed to load article editor', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memuat editor. Silakan coba lagi.');
        }
    }

    /**
     * Save article content (AJAX endpoint for editor)
     */
    public function saveContent(Request $request, int $id): JsonResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return response()->json(['error' => 'Artikel tidak ditemukan.'], 404);
            }

            $validated = $request->validate([
                'judul' => 'nullable|string|max:255',
                'isi_konten' => 'nullable|string',
            ]);

            // Save content
            $this->articleService->saveContent($artikel, $validated);

            return response()->json([
                'success' => true,
                'message' => 'Konten artikel berhasil disimpan.',
                'artikel_id' => $artikel->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save article content', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyimpan konten.'], 500);
        }
    }

    /**
     * Upload article image (AJAX endpoint for editor)
     */
    public function uploadImage(ArticleImageUploadRequest $request, int $id): JsonResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return response()->json(['error' => 'Artikel tidak ditemukan.'], 404);
            }

            // Process image using service
            $imagePath = $this->articleService->processArticleImage($artikel, $request->file('image'));

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diunggah.',
                'file' => [
                    'url' => '/storage/' . $imagePath,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to upload article image', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Show metadata form before publish
     */
    public function showPublishForm(int $id): View|RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            // Only allow publishing if status is draft
            if ($artikel->status !== 'draft') {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Hanya draft artikel yang bisa dipublikasikan.');
            }

            return view('admin.article.publish', compact('artikel'));
        } catch (\Exception $e) {
            Log::error('Failed to load publish form', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memuat form publikasi. Silakan coba lagi.');
        }
    }

    /**
     * Finalize and publish article
     */
    public function publishFinalize(ArticleRequest $request, int $id): RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            // Update metadata
            $this->articleService->updateMetadata($artikel, $request->validated());

            // Publish article
            $this->articleService->publish($artikel);

            return redirect()
                ->route('article.index')
                ->with('success', 'Artikel berhasil dipublikasikan!');
        } catch (\Exception $e) {
            Log::error('Failed to publish article', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return back()
                ->withInput()
                ->with('error', 'Gagal mempublikasikan artikel. Silakan coba lagi.');
        }
    }

    /**
     * Delete article (both draft and published)
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            $this->articleService->delete($artikel);

            return redirect()
                ->route('article.index')
                ->with('success', 'Artikel berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Failed to delete article', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Gagal menghapus artikel. Silakan coba lagi.');
        }
    }

    /**
     * Edit metadata for published article
     */
    public function editMetadata(int $id): View|RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            // Only allow editing metadata if article is published
            if ($artikel->status !== 'publish') {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Hanya artikel yang sudah dipublikasikan yang bisa diedit metadata-nya.');
            }

            // Parse isi_konten untuk extract images
            $artikelContent = json_decode($artikel->isi_konten, true) ?? ['blocks' => []];

            return view('admin.article.edit-metadata', compact('artikel', 'artikelContent'));
        } catch (\Exception $e) {
            Log::error('Failed to load metadata editor', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memuat editor metadata. Silakan coba lagi.');
        }
    }

    /**
     * Update metadata for published article
     */
    public function updateMetadataPublished(ArticleRequest $request, int $id): RedirectResponse
    {
        try {
            $user = auth()->user();
            $artikel = $this->articleService->getByIdForUser($id, $user);

            if (!$artikel) {
                return redirect()
                    ->route('article.index')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            // Update metadata only (not content)
            $this->articleService->updateMetadata($artikel, $request->validated());

            return redirect()
                ->route('article.index')
                ->with('success', 'Metadata artikel berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Failed to update article metadata', ['artikel_id' => $id, 'error' => $e->getMessage()]);
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui metadata artikel. Silakan coba lagi.');
        }
    }

    /**
     * Show public article detail page
     */
    public function show(string $slug): View|RedirectResponse
    {
        try {
            $artikel = Artikel::where('slug', $slug)->firstOrFail();

            // Only show published articles
            if ($artikel->status !== 'publish') {
                return redirect()
                    ->route('landing')
                    ->with('error', 'Artikel tidak ditemukan.');
            }

            // Parse isi_konten untuk ditampilkan
            $artikelContent = json_decode($artikel->isi_konten, true) ?? ['blocks' => []];

            return view('article.show', compact('artikel', 'artikelContent'));
        } catch (\Exception $e) {
            Log::error('Failed to load article detail', ['slug' => $slug, 'error' => $e->getMessage()]);
            return redirect()
                ->route('landing')
                ->with('error', 'Artikel tidak ditemukan.');
        }
    }
}
