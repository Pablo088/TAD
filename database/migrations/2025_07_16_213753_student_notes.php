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
       Schema::create('student_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_idn")->references("id")->on("students")->onDelete("cascade")->onUpdate("cascade");
            $table->json("notes")->nullable();
            $table->float("notes_avg",unsigned:true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("student_notes");
    }
};
