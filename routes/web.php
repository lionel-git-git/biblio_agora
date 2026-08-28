<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Models\Livre;

use App\Http\Controllers\LivreController;

use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/livres/creer', [LivreController::class, 'create'])->name('livres.create');
    Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
});

Route::get('/catalogue', [LivreController::class, 'catalogue'])->name('catalogue');

Route::get('/', function () {
    $nouveautes = Livre::latest()->take(4)->get();
    return view('welcome', compact('nouveautes'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/etudiant/dashboard', [DashboardController::class, 'etudiant'])->name('etudiant.dashboard');
    Route::get('/bibliothecaire/dashboard', [DashboardController::class, 'bibliothecaire'])->name('bibliothecaire.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
