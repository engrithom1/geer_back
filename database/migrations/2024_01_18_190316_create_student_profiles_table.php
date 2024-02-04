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
        
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('age');
            $table->string('sex');
            $table->string('merital');
            $table->string('education_level');
            $table->string('graduate_year');
            $table->string('college');
            $table->string('course');
            $table->string('sector');
            $table->string('contact');
            $table->string('device');
            $table->integer('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
