<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('category'); // e.g., 'pemilihan-varietas', 'manajemen-nutrisi'
            $table->string('type')->default('article'); // 'article' or 'video'
            $table->integer('read_time')->nullable(); // in minutes
            $table->string('duration')->nullable(); // for videos
            $table->string('thumbnail')->nullable(); // path to thumbnail image
            $table->string('video_url')->nullable(); // for videos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
