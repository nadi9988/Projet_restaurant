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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_time');
            $table->string('status')->default('en_preparation');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_mode')->nullable();
            $table->string('delivery_address')->nullable();
            $table->boolean('is_delivery')->default(false);
            $table->foreignId('reservation_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
