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
        Schema::create("careers", function(Blueprint $table){
            $table->id();
            $table->string("name",length:64);
            $table->unsignedSmallInteger("total_years");
            $table->enum("career_divisions",["A","B","C","D"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("careers");
    }
};
