<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;

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
        Route::get('/dashboard', function () {
            return view('admin/dashboard');
        })->name('dashboard');

        // Profile
        Route::get('/profile', function () {
            return view('admin/profile');
        })->name('profile');

        // Edukasi (Education)
        Route::prefix('edukasi')->group(function () {
            Route::get('/index', function () {
                return view('admin/edukasi/index');
            })->name('edukasi.index');

            Route::get('/create', function () {
                return view('admin/edukasi/create');
            })->name('edukasi.create');

            Route::get('/edit', function () {
                return view('admin/edukasi/edit');
            })->name('edukasi.edit');
        });

        // Pengalaman (Experience)
        Route::get('/pengalaman', function () {
            return view('admin/pengalaman');
        })->name('pengalaman');

        // Sertifikat (Certificates)
        Route::prefix('sertifikat')->group(function () {
            Route::get('/index', function () {
                return view('admin/sertifikat/index');
            })->name('sertifikat.index');

            Route::get('/create', function () {
                return view('admin/sertifikat/create');
            })->name('sertifikat.create');

            Route::get('/edit', function () {
                return view('admin/sertifikat/edit');
            })->name('sertifikat.edit');
        });

        // Projects - Resource Controller (CRUD Routes)
        Route::bind('project', function ($value) {
            return \App\Models\Proyek::findOrFail($value);
        });
        Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
        Route::resource('projects', ProjectController::class);

        // Technologies - Resource Controller (CRUD Routes)
        Route::resource('technologies', TechnologyController::class);

        // Articles
        Route::prefix('article')->group(function () {
            Route::get('/index', function () {
                return view('admin/article/index');
            })->name('article.index');
        });
    });
});


