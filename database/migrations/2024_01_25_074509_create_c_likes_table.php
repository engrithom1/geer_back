<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.'','like_id'
     */
    public function up(): void
    {
        Schema::create('c_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('comment_id');
            $table->integer('like_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_likes');
    }
};
