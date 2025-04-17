<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->json('opening_time'); // Format JSON pour stocker les heures d'ouver sma3ti a kniksi
            $table->json('exceptional_days')->nullable(); // Jours fermés exceptionnelle nsdo nhar joumou3a nmxiw nssliw
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horaires');
    }
};
