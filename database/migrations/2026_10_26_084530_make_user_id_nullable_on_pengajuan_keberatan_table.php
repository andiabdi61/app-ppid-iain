<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_keberatan', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->index('nomor_registrasi_permohonan');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_keberatan', function (Blueprint $table) {
            $table->dropIndex(['nomor_registrasi_permohonan']);
        });
    }
};
