<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonan_informasi', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('nama_pemohon')->nullable()->after('user_id');
            $table->string('email_pemohon')->nullable()->after('nama_pemohon');
            $table->string('telp_pemohon', 30)->nullable()->after('email_pemohon');
            $table->text('alamat_pemohon')->nullable()->after('telp_pemohon');
        });
    }

    public function down(): void
    {
        Schema::table('permohonan_informasi', function (Blueprint $table) {
            $table->dropColumn([
                'nama_pemohon',
                'email_pemohon',
                'telp_pemohon',
                'alamat_pemohon',
            ]);
        });
    }
};
