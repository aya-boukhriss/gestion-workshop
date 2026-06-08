<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', [WorkshopController::class, 'index'])->name('home');

// Routes authentification (Breeze)
require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware('auth')->name('dashboard');

// Routes protégées (utilisateur connecté)
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Workshops
    Route::resource('workshops', WorkshopController::class);

    // Inscriptions
    Route::post('/inscription/{workshop}', [InscriptionController::class, 'store'])->name('inscription.store');
    Route::delete('/inscription/{inscription}', [InscriptionController::class, 'destroy'])->name('inscription.destroy');

    // Certificats
    Route::get('/certificat/{certificat}', [CertificatController::class, 'download'])->name('certificat.download');

    // Espace participant
    Route::get('/mon-espace', [InscriptionController::class, 'monEspace'])->name('mon.espace');

    // Evaluations
    Route::post('/evaluation/{inscription}', [EvaluationController::class, 'store'])->name('evaluation.store');
});

// Routes Formateur
Route::middleware(['auth', 'role:formateur,admin'])->prefix('formateur')->name('formateur.')->group(function () {
    Route::get('/dashboard', [FormateurController::class, 'dashboard'])->name('dashboard');
    Route::get('/mes-workshops', [FormateurController::class, 'mesWorkshops'])->name('workshops');
    Route::get('/participants/{workshop}', [FormateurController::class, 'participants'])->name('participants');
});

// Routes Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');
});

// Routes Manager
Route::middleware(['auth', 'role:manager,admin'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'index'])->name('dashboard');
    Route::get('/evaluations', [ManagerController::class, 'evaluations'])->name('evaluations');
});