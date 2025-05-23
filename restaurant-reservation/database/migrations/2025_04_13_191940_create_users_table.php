<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) { // <-- corrigé ici
            $table->id();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone')->nullable();
            $table->date('InscriptionDate');
            $table->boolean('isActive')->default(true);
            $table->string('type')->default('client'); // 'client' or 'administrator'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users'); // <-- corrigé ici aussi
    }
};
