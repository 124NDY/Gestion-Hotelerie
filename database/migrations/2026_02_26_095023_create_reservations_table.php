<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('chambre_id')->constrained()->onDelete('cascade');
            $table->date('date_arrivee');
            $table->date('date_depart');
            $table->enum('statut', ['confirmee', 'annulee', 'terminee'])->default('confirmee');
            $table->decimal('montant_total', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};