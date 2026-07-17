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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_ar')->nullable()->after('title_en');
            
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->text('excerpt_ar')->nullable()->after('excerpt_en');
            
            $table->longText('content_html_en')->nullable()->after('content_html');
            $table->longText('content_html_ar')->nullable()->after('content_html_en');
        });

        Schema::table('dokumen', function (Blueprint $table) {
            $table->string('judul_en')->nullable()->after('judul');
            $table->string('judul_ar')->nullable()->after('judul_en');
            
            $table->text('deskripsi_en')->nullable()->after('deskripsi');
            $table->text('deskripsi_ar')->nullable()->after('deskripsi_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'title_en', 'title_ar',
                'excerpt_en', 'excerpt_ar',
                'content_html_en', 'content_html_ar'
            ]);
        });

        Schema::table('dokumen', function (Blueprint $table) {
            $table->dropColumn([
                'judul_en', 'judul_ar',
                'deskripsi_en', 'deskripsi_ar'
            ]);
        });
    }
};
