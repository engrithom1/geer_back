<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('student_employments', function (Blueprint $table) {
            $table->id();
            $table->string('obstacles');
            $table->string('carrier_path');
            $table->string('engaged');
            $table->string('income');
            $table->string('job_seeker');
            $table->string('activity');
            $table->string('enterprise');
            $table->string('enterprise_challenge');
            $table->string('job_applied');
            $table->string('interviews');
            $table->integer('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_employments');
    }
};
