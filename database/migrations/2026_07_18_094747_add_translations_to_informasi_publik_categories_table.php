<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_publik_categories', function (Blueprint $table) {
            $table->string('nama_en')->nullable()->after('nama');
            $table->string('nama_ar')->nullable()->after('nama_en');
            $table->text('deskripsi_en')->nullable()->after('deskripsi');
            $table->text('deskripsi_ar')->nullable()->after('deskripsi_en');
        });
    }

    public function down(): void
    {
        Schema::table('informasi_publik_categories', function (Blueprint $table) {
            $table->dropColumn(['nama_en', 'nama_ar', 'deskripsi_en', 'deskripsi_ar']);
        });
    }
};
