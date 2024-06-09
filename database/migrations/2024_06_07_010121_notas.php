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
        Schema::create("notas", function(Blueprint $table){
            $table->id();
            $table->foreignId("student_idn")->references("id")->on("students")->onDelete("cascade")->onUpdate("cascade");
            $table->integer("nota1");
            $table->integer("nota2");
            $table->integer("nota3");
            $table->integer("prom");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("notas");
    }
};
