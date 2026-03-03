<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProfileController;

// 🔐 Routes protégées par authentification
Route::middleware(['auth'])->group(function () {

    // 📊 Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // 🏠 Chambres — Admin seulement pour créer/modifier/supprimer
    Route::get('chambres', [ChambreController::class, 'index'])->name('chambres.index');
    Route::get('chambres/{chambre}', [ChambreController::class, 'show'])->name('chambres.show');
    Route::middleware('role:admin')->group(function () {
        Route::get('chambres/create', [ChambreController::class, 'create'])->name('chambres.create');
        Route::post('chambres', [ChambreController::class, 'store'])->name('chambres.store');
        Route::get('chambres/{chambre}/edit', [ChambreController::class, 'edit'])->name('chambres.edit');
        Route::put('chambres/{chambre}', [ChambreController::class, 'update'])->name('chambres.update');
        Route::delete('chambres/{chambre}', [ChambreController::class, 'destroy'])->name('chambres.destroy');
    });

    // 👤 Clients
    Route::resource('clients', ClientController::class);
    Route::get('clients/{client}/historique', [ClientController::class, 'historique'])->name('clients.historique');

    // 📅 Réservations
    Route::resource('reservations', ReservationController::class);
    Route::patch('reservations/{reservation}/annuler', [ReservationController::class, 'annuler'])->name('reservations.annuler');

    // 💳 Paiements
    Route::resource('paiements', PaiementController::class);

    // 🧾 Factures
    Route::get('factures', [FactureController::class, 'index'])->name('factures.index');
    Route::get('factures/{reservation}/generer', [FactureController::class, 'generer'])->name('factures.generer');
    Route::get('factures/{facture}/pdf', [FactureController::class, 'pdf'])->name('factures.pdf');

    // 👤 Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';