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
        Schema::create("divisions", function(Blueprint $table){
            $table->id();
            $table->foreignId('student_idd')->references("id")->on("students")->onDelete("cascade")->onUpdate("cascade");
            $table->enum("division",[1,2,3,4,5,6]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("divisions");
    }
};
