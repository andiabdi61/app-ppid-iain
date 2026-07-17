<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
    {
        Schema::table('informasi_publik', function (Blueprint $table) {
            $table->string('pejabat', 255)->nullable()->after('konten');
            $table->string('penanggung_jawab', 255)->nullable()->after('pejabat');
            $table->string('tempat', 255)->nullable()->after('penanggung_jawab');
            $table->string('jangka_waktu', 255)->nullable()->after('tempat');
        });
    }

    public function down()
    {
        Schema::table('informasi_publik', function (Blueprint $table) {
            $table->dropColumn(['pejabat', 'penanggung_jawab', 'tempat', 'jangka_waktu']);
        });
    }
};
