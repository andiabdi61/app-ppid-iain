<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sop_layanan', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('judul');
        });

        $used = [];
        foreach (DB::table('sop_layanan')->orderBy('id')->get() as $row) {
            $base = Str::slug($row->judul) ?: 'sop';
            $slug = $base;
            $i = 2;
            while (in_array($slug, $used, true)) {
                $slug = $base . '-' . $i++;
            }
            $used[] = $slug;
            DB::table('sop_layanan')->where('id', $row->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('sop_layanan', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
