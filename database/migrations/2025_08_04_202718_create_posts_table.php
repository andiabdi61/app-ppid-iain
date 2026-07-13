<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // ✅ BIGINT UNSIGNED
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content_html')->nullable();
            $table->string('featured_image_url')->nullable();
            
            // ✅ Sekarang cocok: BIGINT → BIGINT
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            
            // ✅ Sekarang cocok: BIGINT → BIGINT
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->unsignedBigInteger('hits')->default(0);
            $table->unsignedBigInteger('share_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};