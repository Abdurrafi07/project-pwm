<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\NoAuth\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\UserAksesController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DaerahController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\NoAuth\PublicUmkmController;
use App\Http\Controllers\Admin\SektorController;
use App\Http\Controllers\NoAuth\PublicPengurusController;
use App\Http\Controllers\NoAuth\PublicNewsController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\NoAuth\PublicLowonganController;

// =========================
// Public Routes
// =========================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public UMKM (tanpa login)
Route::get('/umkm', [PublicUmkmController::class, 'index'])->name('noauth.umkm.index');
Route::get('/pengurus', [PublicPengurusController::class, 'index'])->name('noauth.pengurus.index');
Route::get('/news', [PublicNewsController::class, 'index'])->name('noauth.news.index');
Route::get('/news/{id}', [PublicNewsController::class, 'show'])->name('noauth.news.show');
Route::get('/lowongan', [PublicLowonganController::class, 'index'])->name('noauth.lowongan.index');
Route::get('/lowongan/{lowongan}', [PublicLowonganController::class, 'show'])->name('noauth.lowongan.show');

// After registration or approval status
Route::get('/pending-approval', [HomeController::class, 'pendingApproval'])->name('pending-approval');
Route::get('/registration-success', [HomeController::class, 'registrationSuccess'])->name('registration-success');

require __DIR__.'/auth.php';

// =========================
// Protected Routes (Approved + Active users only)
// =========================
Route::middleware(['auth', 'verified', 'approved', 'active'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// =========================
// Admin Routes
// =========================
Route::middleware(['auth', 'admin', 'active'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // CRUD resources
        Route::resources([
            'kategori' => KategoriController::class,
            'daerah'   => DaerahController::class,
            'umkm'     => UmkmController::class,
            'news'     => NewsController::class,
            'penguruses' => PengurusController::class,
            'sektor'   => SektorController::class,
            'lowongan' => LowonganController::class,
        ]);

        // Lowongan management
        Route::get('lowongan-history', [LowonganController::class, 'history'])->name('lowongan.history');

        // User management
        Route::prefix('users')->group(function () {
            Route::get('/', [UserAksesController::class, 'index'])->name('users.index'); // Navbar link
            Route::get('/pending', [UserAksesController::class, 'pendingUsers'])->name('users.pending');
            Route::get('/all', [UserAksesController::class, 'allUsers'])->name('users.all');

            // Tambah akun
            Route::get('/create', [UserAksesController::class, 'create'])->name('users.create');
            Route::post('/', [UserAksesController::class, 'store'])->name('users.store');

            // Edit akun
            Route::get('/{user}/edit', [UserAksesController::class, 'edit'])->name('users.edit');
            Route::put('/{user}', [UserAksesController::class, 'update'])->name('users.update');

            // Approve / Reject / Activate / Deactivate / Delete
            Route::post('/{user}/approve', [UserAksesController::class, 'approveUser'])->name('approve-user');
            Route::delete('/{user}/reject', [UserAksesController::class, 'rejectUser'])->name('reject-user');

            Route::post('/{user}/deactivate', [UserAksesController::class, 'deactivateUser'])->name('users.deactivate');
            Route::post('/{user}/activate', [UserAksesController::class, 'activateUser'])->name('users.activate');
            Route::delete('/{user}', [UserAksesController::class, 'deleteUser'])->name('users.delete');
        });
    });

// =========================
// User Routes
// =========================
Route::middleware(['auth', 'approved', 'active'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    });
