<?php

use Illuminate\Support\Facades\Route;
use App\Models\Proyek;
use App\Models\Pendidikan;
use App\Models\Sertifikat;
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
use App\Http\Controllers\FooterController;
use App\Http\Controllers\LandingPageController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/project/{id}', [ProjectController::class, 'showPublic'])->where('id', '[0-9]+')->name('project.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/password/forgot', [AuthController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('/password/forgot', [AuthController::class, 'forgotPassword'])->name('password.send-reset');

    Route::get('/password/reset', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [HeroSectionController::class, 'edit'])->name('profile');

        Route::put('/hero-section', [HeroSectionController::class, 'update'])->name('hero-section.update');

        Route::bind('pendidikan', function ($value) {
            return Pendidikan::findOrFail($value);
        });
        Route::post('/pendidikans/reorder', [PendidikanController::class, 'reorder'])->name('pendidikans.reorder');
        Route::resource('pendidikans', PendidikanController::class);

        Route::get('/pengalaman', [PengalamanController::class, 'index'])->name('pengalaman.index');
        Route::post('/pengalaman', [PengalamanController::class, 'update'])->name('pengalaman.update');
        Route::post('/pengalaman/reorder', [PengalamanController::class, 'reorder'])->name('pengalaman.reorder');

        Route::bind('project', function ($value) {
            return Proyek::findOrFail($value);
        });
        Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
        Route::resource('projects', ProjectController::class);

        Route::bind('sertifikat', function ($value) {
            return Sertifikat::findOrFail($value);
        });
        Route::post('/sertifikats/reorder', [SertifikatController::class, 'reorder'])->name('sertifikats.reorder');
        Route::resource('sertifikats', SertifikatController::class);

        Route::resource('technologies', TechnologyController::class);

        Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors');

        Route::get('/footer', [FooterController::class, 'index'])->name('admin.footer.index');
        Route::get('/footer/create', [FooterController::class, 'create'])->name('admin.footer.create');
        Route::post('/footer', [FooterController::class, 'store'])->name('admin.footer.store');
        Route::get('/footer/{footer}/edit', [FooterController::class, 'edit'])->name('admin.footer.edit');
        Route::put('/footer/{footer}', [FooterController::class, 'update'])->name('admin.footer.update');
        Route::delete('/footer/{footer}', [FooterController::class, 'destroy'])->name('admin.footer.destroy');

        Route::prefix('article')->group(function () {
            Route::get('/index', [ArticleController::class, 'index'])->name('article.index');
            Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
            Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
            Route::post('/{id}/save-content', [ArticleController::class, 'saveContent'])->name('article.save-content');
            Route::post('/{id}/upload-image', [ArticleController::class, 'uploadImage'])->name('article.upload-image');
            Route::get('/{id}/publish', [ArticleController::class, 'showPublishForm'])->name('article.publish-form');
            Route::post('/{id}/publish-finalize', [ArticleController::class, 'publishFinalize'])->name('article.publish-finalize');
            Route::get('/{id}/edit-metadata', [ArticleController::class, 'editMetadata'])->name('article.edit-metadata');
            Route::put('/{id}/metadata', [ArticleController::class, 'updateMetadataPublished'])->name('article.update-metadata');
            Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
        });
    });
});
