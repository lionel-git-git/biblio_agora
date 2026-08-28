<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Livre;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $nouveautes = Livre::latest()->take(4)->get();

    return view('welcome', compact('nouveautes'));
});

Route::get('/catalogue', [LivreController::class, 'catalogue'])->name('catalogue');

Route::view('/services', 'services')->name('services');
Route::view('/aide', 'aide')->name('aide');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');

    Route::get('/mes-emprunts', [EmpruntController::class, 'index'])->name('emprunts.index');
    Route::post('/livres/{livre}/demande', [EmpruntController::class, 'store'])->name('emprunts.store');
});

Route::middleware(['auth', 'verified', 'role:etudiant'])->group(function () {
    Route::get('/etudiant/dashboard', [DashboardController::class, 'etudiant'])->name('etudiant.dashboard');
});

Route::middleware(['auth', 'verified', 'role:bibliothecaire,admin'])->group(function () {
    Route::get('/bibliothecaire/dashboard', [DashboardController::class, 'bibliothecaire'])->name('bibliothecaire.dashboard');

    Route::get('/livres/gestion', [LivreController::class, 'index'])->name('livres.index');
    Route::get('/livres/creer', [LivreController::class, 'create'])->name('livres.create');
    Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
    Route::get('/livres/{livre}/modifier', [LivreController::class, 'edit'])->name('livres.edit');
    Route::put('/livres/{livre}', [LivreController::class, 'update'])->name('livres.update');
    Route::delete('/livres/{livre}', [LivreController::class, 'destroy'])->name('livres.destroy');

    Route::get('/gestion-emprunts', [EmpruntController::class, 'gestion'])->name('emprunts.gestion');
    Route::patch('/emprunts/{emprunt}/valider', [EmpruntController::class, 'valider'])->name('emprunts.valider');
    Route::patch('/emprunts/{emprunt}/refuser', [EmpruntController::class, 'refuser'])->name('emprunts.refuser');
    Route::patch('/emprunts/{emprunt}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/admin/utilisateurs', [UserController::class, 'index'])->name('admin.utilisateurs');
    Route::patch('/admin/utilisateurs/{user}/role', [UserController::class, 'updateRole'])->name('admin.utilisateurs.role');
    Route::delete('/admin/utilisateurs/{user}', [UserController::class, 'destroy'])->name('admin.utilisateurs.destroy');

    Route::get('/admin/messages', [ContactController::class, 'indexAdmin'])->name('admin.messages');
    Route::patch('/admin/messages/{message}/lu', [ContactController::class, 'marquerLu'])->name('admin.messages.lu');
    Route::delete('/admin/messages/{message}', [ContactController::class, 'destroy'])->name('admin.messages.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
