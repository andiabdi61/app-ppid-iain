<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sop_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal_pembuatan');
            $table->date('tanggal_efektif');
            $table->string('penandatangan');
            $table->string('file_path');
            $table->string('file_nama');
            $table->string('status', 20)->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sop_layanan');
    }
};
