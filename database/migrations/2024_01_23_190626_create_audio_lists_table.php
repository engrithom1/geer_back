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
        Schema::create('audio_lists', function (Blueprint $table) {
            $table->id();
            $table->string('sub_title');
            $table->string('audio_url');
            $table->string('label');
            $table->integer('created_by');
            $table->integer('order');
            $table->foreignId('audios_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_lists');
    }
};
