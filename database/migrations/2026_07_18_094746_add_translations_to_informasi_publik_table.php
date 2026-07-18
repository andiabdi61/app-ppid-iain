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
        Schema::table('informasi_publik', function (Blueprint $table) {
            // Terjemahan Judul
            $table->string('judul_en')->nullable()->after('judul');
            $table->string('judul_ar')->nullable()->after('judul_en');

            // Terjemahan Konten
            $table->longText('konten_en')->nullable()->after('konten');
            $table->longText('konten_ar')->nullable()->after('konten_en');

            // Terjemahan Pejabat
            $table->string('pejabat_en', 255)->nullable()->after('pejabat');
            $table->string('pejabat_ar', 255)->nullable()->after('pejabat_en');

            // Terjemahan Penanggung Jawab
            $table->string('penanggung_jawab_en', 255)->nullable()->after('penanggung_jawab');
            $table->string('penanggung_jawab_ar', 255)->nullable()->after('penanggung_jawab_en');

            // Terjemahan Tempat
            $table->string('tempat_en', 255)->nullable()->after('tempat');
            $table->string('tempat_ar', 255)->nullable()->after('tempat_en');

            // Terjemahan Jangka Waktu
            $table->string('jangka_waktu_en', 255)->nullable()->after('jangka_waktu');
            $table->string('jangka_waktu_ar', 255)->nullable()->after('jangka_waktu_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi_publik', function (Blueprint $table) {
            $table->dropColumn([
                'judul_en', 'judul_ar',
                'konten_en', 'konten_ar',
                'pejabat_en', 'pejabat_ar',
                'penanggung_jawab_en', 'penanggung_jawab_ar',
                'tempat_en', 'tempat_ar',
                'jangka_waktu_en', 'jangka_waktu_ar',
            ]);
        });
    }
};
