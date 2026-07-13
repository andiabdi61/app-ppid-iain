<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('informasi_publik', function (Blueprint $table) {
            // Cek dulu, kalau belum ada baru ditambahkan
            if (!Schema::hasColumn('informasi_publik', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
            
            if (!Schema::hasColumn('informasi_publik', 'jenis_tautan')) {
                $table->string('jenis_tautan', 10)->default('file')->after('sort_order');
            }
            
            if (!Schema::hasColumn('informasi_publik', 'tautan_eksternal')) {
                $table->string('tautan_eksternal')->nullable()->after('jenis_tautan');
            }
            
            if (!Schema::hasColumn('informasi_publik', 'parent_id')) {
                $table->foreignId('parent_id')->nullable()->constrained('informasi_publik')->nullOnDelete()->after('category_id');
            }
        });

        Schema::table('informasi_publik_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('informasi_publik_categories', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('deskripsi');
            }
        });
    }

    public function down()
    {
        Schema::table('informasi_publik', function (Blueprint $table) {
            if (Schema::hasColumn('informasi_publik', 'parent_id')) {
                $table->dropConstrainedForeignId('parent_id');
            }
            if (Schema::hasColumn('informasi_publik', 'sort_order')) {
                $table->dropColumn(['sort_order', 'jenis_tautan', 'tautan_eksternal']);
            }
        });

        Schema::table('informasi_publik_categories', function (Blueprint $table) {
            if (Schema::hasColumn('informasi_publik_categories', 'sort_order')) {
                $table->dropColumn(['sort_order']);
            }
        });
    }
};