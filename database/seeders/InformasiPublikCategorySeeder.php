<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InformasiPublikCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informasi_publik_categories')->insert([
            [
                'id' => 1,
                'nama' => 'Informasi Publik Wajib Berkala',
                'slug' => 'informasi-berkala',
                'deskripsi' => 'Informasi yang wajib diumumkan secara berkala, minimal 6 bulan sekali.',
                'created_at' => '2025-07-24 05:00:56',
                'updated_at' => '2025-07-24 05:00:56',
            ],
            [
                'id' => 2,
                'nama' => 'Informasi Wajib Diumumkan Serta Merta',
                'slug' => 'informasi-serta-merta',
                'deskripsi' => 'Informasi yang wajib diumumkan segera tanpa penundaan jika dapat mengancam hajat hidup orang banyak.',
                'created_at' => '2025-07-24 05:00:56',
                'updated_at' => '2025-07-24 05:00:56',
            ],
            [
                'id' => 3,
                'nama' => 'Informasi Wajib Tersedia Setiap Saat',
                'slug' => 'informasi-setiap-saat',
                'deskripsi' => 'Informasi yang wajib tersedia setiap saat, dapat diakses kapan pun oleh masyarakat.',
                'created_at' => '2025-07-24 05:00:56',
                'updated_at' => '2025-07-24 05:00:56',
            ],
            [
                'id' => 4,
                'nama' => 'Informasi Dikecualikan',
                'slug' => 'informasi-dikecualikan',
                'deskripsi' => 'Informasi Dikecualikan',
                'created_at' => '2025-07-24 05:00:56',
                'updated_at' => '2025-07-24 05:00:56',
            ],
            [
                'id' => 5,
                'nama' => 'Barang dan Jasa',
                'slug' => 'barang-dan-jasa',
                'deskripsi' => 'Barang dan Jasa',
                'created_at' => '2025-07-24 05:00:56',
                'updated_at' => '2025-07-24 05:00:56',
            ],
            
        ]);
    }
}