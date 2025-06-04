<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('forum_categories')->onDelete('cascade');
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('replies_count')->default(0);
            $table->timestamp('last_activity_at')->nullable();
            $table->foreignId('last_reply_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['category_id', 'is_pinned', 'last_activity_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum_topics');
    }
};
