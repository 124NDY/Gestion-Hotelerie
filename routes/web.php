<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $rooms = \App\Models\Room::where('statut', 'disponible')->take(6)->get();
    return view('welcome', compact('rooms'));
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');

    // Chambres
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

    Route::middleware(['role:admin,receptionniste'])->group(function () {
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::get('/rooms/{room}/statut', [RoomController::class, 'updateStatut'])->name('rooms.statut');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    });

    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    // Reservations
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}/annuler', [BookingController::class, 'annuler'])->name('bookings.annuler');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

    // Paiements
    Route::middleware(['role:admin,receptionniste'])->group(function () {
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/create/{booking}', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/payments/{payment}/facture', [PaymentController::class, 'facture'])->name('payments.facture');
        Route::get('/payments/{payment}/facture/pdf', [PaymentController::class, 'facturePdf'])->name('payments.facture.pdf');
    });

    // Clients et Staff - admin uniquement
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/users', UserController::class);
    });

    // Avis
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
});