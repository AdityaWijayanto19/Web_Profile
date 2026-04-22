<?php

namespace App\Http\Controllers;

use App\Services\HeroSectionService;
use App\Services\PendidikanService;
use App\Services\SertifikatService;
use App\Services\PengalamanService;
use App\Services\ProjectService;
use App\Services\ArticleService;
use App\Services\FooterService;

class LandingPageController extends Controller
{
    private HeroSectionService $heroSectionService;
    private PendidikanService $pendidikanService;
    private SertifikatService $sertifikatService;
    private PengalamanService $pengalamanService;
    private ProjectService $projectService;
    private ArticleService $articleService;
    private FooterService $footerService;

    public function __construct(
        HeroSectionService $heroSectionService,
        PendidikanService $pendidikanService,
        SertifikatService $sertifikatService,
        PengalamanService $pengalamanService,
        ProjectService $projectService,
        ArticleService $articleService,
        FooterService $footerService,
    ) {
        $this->heroSectionService = $heroSectionService;
        $this->pendidikanService = $pendidikanService;
        $this->sertifikatService = $sertifikatService;
        $this->pengalamanService = $pengalamanService;
        $this->projectService = $projectService;
        $this->articleService = $articleService;
        $this->footerService = $footerService;
    }

    public function index()
    {
        $hero = $this->heroSectionService->getHero();
        $educations = $this->pendidikanService->getAll();
        $sertifikats = $this->sertifikatService->getAll();
        $pengalaman = $this->pengalamanService->getAll();
        $projects = $this->projectService->getPublishedAll();
        $articles = $this->articleService->getAllPublished();
        $footer = $this->footerService->getMain();

        return view('welcome', compact('hero', 'educations', 'sertifikats', 'pengalaman', 'projects', 'articles', 'footer'));
    }
}

