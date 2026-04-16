<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ArticleController;

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('welcome');
});

// ==================== AUTH ROUTES (Guest Only) ====================
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Forgot Password Routes
    Route::get('/password/forgot', [AuthController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('/password/forgot', [AuthController::class, 'forgotPassword'])->name('password.send-reset');

    // Reset Password Routes
    Route::get('/password/reset', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

// ==================== AUTH ROUTES (Protected) ====================
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ==================== ADMIN ROUTES ====================
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile (managed by HeroSectionController)
        Route::get('/profile', [HeroSectionController::class, 'edit'])->name('profile');

        // Hero Section (Singleton - only edit/update)
        Route::put('/hero-section', [HeroSectionController::class, 'update'])->name('hero-section.update');

        // Pendidikan (Education) - Resource Controller (CRUD Routes)
        Route::bind('pendidikan', function ($value) {
            return \App\Models\Pendidikan::findOrFail($value);
        });
        Route::post('/pendidikans/reorder', [PendidikanController::class, 'reorder'])->name('pendidikans.reorder');
        Route::resource('pendidikans', PendidikanController::class);

        // Pengalaman (Experience) - Read & Update only (3 fixed records)
        Route::get('/pengalaman', [PengalamanController::class, 'index'])->name('pengalaman.index');
        Route::post('/pengalaman', [PengalamanController::class, 'update'])->name('pengalaman.update');
        Route::post('/pengalaman/reorder', [PengalamanController::class, 'reorder'])->name('pengalaman.reorder');

        // Projects - Resource Controller (CRUD Routes)
        Route::bind('project', function ($value) {
            return \App\Models\Proyek::findOrFail($value);
        });
        Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
        Route::resource('projects', ProjectController::class);

        // Sertifikats - Resource Controller (CRUD Routes)
        Route::bind('sertifikat', function ($value) {
            return \App\Models\Sertifikat::findOrFail($value);
        });
        Route::post('/sertifikats/reorder', [SertifikatController::class, 'reorder'])->name('sertifikats.reorder');
        Route::resource('sertifikats', SertifikatController::class);

        // Technologies - Resource Controller (CRUD Routes)
        Route::resource('technologies', TechnologyController::class);

        // Visitors - Read only (Analytics)
        Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors');

        // Articles
        Route::prefix('article')->group(function () {
            Route::get('/index', [ArticleController::class, 'index'])->name('article.index');
            Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
            Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
            Route::post('/{id}/save-content', [ArticleController::class, 'saveContent'])->name('article.save-content');
            Route::get('/{id}/publish', [ArticleController::class, 'showPublishForm'])->name('article.publish-form');
            Route::post('/{id}/publish-finalize', [ArticleController::class, 'publishFinalize'])->name('article.publish-finalize');
            Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
        });
    });
});


