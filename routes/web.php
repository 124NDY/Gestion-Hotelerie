<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaiementController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Chambres
    Route::resource('chambres', ChambreController::class);

    // Clients
    Route::resource('clients', ClientController::class);
    Route::get('clients/{client}/historique', [ClientController::class, 'historique'])->name('clients.historique');

    // Reservations
    Route::resource('reservations', ReservationController::class);
    Route::get('reservations/{reservation}/annuler', [ReservationController::class, 'annuler'])->name('reservations.annuler');
    Route::get('reservations/historique', [ReservationController::class, 'historique'])->name('reservations.historique');

    // Paiements
    Route::get('paiements/historique', [PaiementController::class, 'historique'])->name('paiements.historique');
    Route::get('paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
    Route::post('paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('paiements/{paiement}/facture', [PaiementController::class, 'facture'])->name('paiements.facture');
    Route::get('paiements/{paiement}', [PaiementController::class, 'show'])->name('paiements.show');
    Route::get('paiements', [PaiementController::class, 'index'])->name('paiements.index');
});

require __DIR__.'/auth.php';