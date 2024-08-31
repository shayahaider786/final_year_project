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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description');
            $table->string('video_path')->nullable();
            $table->string('prize1_image_path')->nullable();
            $table->string('prize1_description')->nullable();
            $table->string('prize2_image_path')->nullable();
            $table->string('prize2_description')->nullable();
            $table->string('prize3_image_path')->nullable();
            $table->string('prize3_description')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
