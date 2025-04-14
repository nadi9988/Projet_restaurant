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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->dateTime('payment_date');
            $table->string('payment_method');
            $table->string('status');
            $table->string('reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
