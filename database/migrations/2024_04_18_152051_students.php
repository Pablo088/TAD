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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId("career_id")->references("id")->on("careers")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedInteger("dni");
            $table->string("name",length:64);
            $table->date("birthDate");
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
        Schema::dropIfExists('students');
    }
};
