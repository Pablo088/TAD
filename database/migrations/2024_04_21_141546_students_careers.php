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
        Schema::create("students_careers", function(Blueprint $table){
            $table->id();
            $table->foreignId("student_idc")->references("id")->on("students")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("career_idc")->references("id")->on("careers")->onDelete("cascade")->onUpdate("cascade");
            $table->integer("current_year",unsigned:true);
            $table->string("division",length:1);
            $table->json("notes")->nullable();
            $table->integer("notes_avg",unsigned:true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("students_careers");
    }
};
