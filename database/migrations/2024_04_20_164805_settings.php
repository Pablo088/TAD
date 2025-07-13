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
            $table->id();
            $table->integer("dias_clases",unsigned:true);
            $table->integer("promedio_promocion",unsigned:true);
            $table->integer("promedio_regularidad",unsigned:true);
            $table->integer("edad_minima",unsigned:true);
            $table->timestamps();
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
