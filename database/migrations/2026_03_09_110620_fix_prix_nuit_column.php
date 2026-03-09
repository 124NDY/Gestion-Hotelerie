<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('prix_nuit', 15, 2)->change();
        });
    }
    
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('prix_nuit', 8, 2)->change();
        });
    }
};
