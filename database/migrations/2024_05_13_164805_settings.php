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
        Schema::create("settings",function(Blueprint $table){
            $table->integer("dias_clases");
            $table->integer("promedio_promocion");
            $table->integer("promedio_regularidad");
            $table->integer("edad_minima");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("settings");
    }
};
