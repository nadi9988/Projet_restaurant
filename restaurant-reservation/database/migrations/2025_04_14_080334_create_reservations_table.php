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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_time');
            $table->integer('number_of_people');
            $table->string('status')->default('en_attente');
            $table->text('comments')->nullable();
            $table->text('order_pre_dishes')->nullable(); // ila bgha yakl xi 7aja khfifa 9bl maywjd lplat dialo ! ou n9adro ndirohoum suggetion f .json
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
