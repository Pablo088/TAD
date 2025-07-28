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
          Schema::create('students_careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("career_id")->references("id")->on("careers")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("student_id")->unique()->references("id")->on("students")->onDelete("cascade")->onUpdate("cascade");          
            $table->unsignedSmallInteger("current_year");
            $table->string("division",length:1);
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
