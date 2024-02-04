<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * '','','','','','',
     * '','','',''
     */
    public function up(): void
    {
        Schema::create('student_needs', function (Blueprint $table) {
            $table->id();
            $table->string('capacity');
            $table->string('capacity_institution');
            $table->string('capacity_type');
            $table->string('training');
            $table->string('why_training');
            $table->string('skill_need');
            $table->string('critical_skills');
            $table->string('training_time');
            $table->string('disability');
            $table->string('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_needs');
    }
};
