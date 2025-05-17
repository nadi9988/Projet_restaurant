<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('livreurs', function (Blueprint $table) {
            $table->string('etat')->default('actif');
        });
    }

    public function down()
    {
        Schema::table('livreurs', function (Blueprint $table) {
            $table->dropColumn('etat');
        });
    }

};