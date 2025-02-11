<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PartController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/inventory', [CarController::class, 'index'])->name('inventory.index');

    
    Route::post('/inventory/car', [CarController::class, 'store'])->name('inventory.car.store');
    Route::put('/inventory/car/{car}', [CarController::class, 'update'])->name('inventory.car.update');
    Route::delete('/inventory/car/{car}', [CarController::class, 'destroy'])->name('inventory.car.destroy');

    Route::get('/inventory/part{car}', [PartController::class, 'index'])->name('inventory.part.index');
    Route::put('/inventory/part/{part}', [PartController::class, 'update'])->name('inventory.part.update');
    Route::post('/inventory/part', [PartController::class, 'store'])->name('inventory.part.store');
    Route::delete('/inventory/part/{part}', [PartController::class, 'destroy'])->name('inventory/part.destroy');
    // Route::get('/inventory', [CarController::class, 'index'])->name('inventory.index');
});

    // ->middleware(['auth', 'verified']);

// Route::get('/inventory', function(){
//     return Inertia::render('Inventory');})->name('test');

require __DIR__.'/auth.php';
