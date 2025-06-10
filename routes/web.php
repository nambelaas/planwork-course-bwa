<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::get('testing', fn() => Inertia::render('Testing'));

Route::controller(WorkspaceController::class)->group(function () {
    Route::get('workspace/create', 'create')->name('workspaces.create');
    Route::post('workspace/create', 'store')->name('workspaces.store');
    Route::get('workspace/p/{workspace:slug}', 'show')->name('workspaces.show');
    Route::get('workspace/edit/{workspace:slug}', 'edit')->name('workspaces.edit');
    Route::put('workspace/edit/{workspace:slug}', 'update')->name('workspaces.update');
    Route::delete('workspace/edit/{workspace:slug}', 'destroy')->name('workspaces.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
