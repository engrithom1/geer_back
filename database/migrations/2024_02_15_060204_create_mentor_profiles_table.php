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
        Schema::create('mentor_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('age');
            $table->string('sex');
            $table->string('experience');
            $table->string('education_level');
            $table->string('time');
            $table->string('expertise');
            $table->string('mentees');
            $table->string('skills');
            $table->string('interest');
            $table->string('contact');
            $table->integer('mentor_id');
            $table->integer('user_id');
            $table->string('groups');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_profiles');
    }
};
