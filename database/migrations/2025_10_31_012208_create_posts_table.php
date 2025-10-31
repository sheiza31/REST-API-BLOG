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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longtext('content');
            $table->longtext('raw_content');
            $table->string('visibility')->default('public');
            $table->text('execerpt')->nullable();
            $table->timestamp('published_at');
            $table->integer('reading_time_minutes');
            $table->string('status')->default('draft');
            $table->foreignId('author_id')->nullable();
            $table->foreignId('cover_media_id');
            $table->JSON('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
