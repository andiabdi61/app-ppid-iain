<?php

namespace Tests\Feature;

use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminGuestDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_and_search_guest_permohonan(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        $permohonan = $this->createPermohonan();

        $this->actingAs($admin)
            ->get(route('admin.permohonan.index', ['q' => 'pemohon@example.com']))
            ->assertOk()
            ->assertSee('Pemohon Tamu')
            ->assertSee('pemohon@example.com')
            ->assertSee('Tamu');

        $this->actingAs($admin)
            ->get(route('admin.permohonan.show', $permohonan))
            ->assertOk()
            ->assertSee('Pemohon Tamu')
            ->assertSee('081234567890')
            ->assertSee('Alamat Pemohon');
    }

    public function test_admin_can_see_and_search_guest_keberatan(): void
    {
        $admin = User::factory()->create(['role' => 'ppid_admin']);
        $permohonan = $this->createPermohonan();

        $keberatan = PengajuanKeberatan::create([
            'user_id' => null,
            'nomor_registrasi_permohonan' => $permohonan->nomor_registrasi,
            'alasan_keberatan' => 'Alasan keberatan',
            'jenis_keberatan' => 'Info Ditolak',
            'kasus_posisi' => 'Kasus posisi',
            'status' => 'Menunggu Diproses',
            'tanggal_pengajuan' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.keberatan.index', ['q' => 'pemohon@example.com']))
            ->assertOk()
            ->assertSee('Pemohon Tamu')
            ->assertSee('pemohon@example.com')
            ->assertSee('Tamu');

        $this->actingAs($admin)
            ->get(route('admin.keberatan.show', $keberatan))
            ->assertOk()
            ->assertSee('Pemohon Tamu')
            ->assertSee('081234567890')
            ->assertSee('Alamat Pemohon');
    }

    public function test_super_admin_dashboard_renders_guest_names(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        $permohonan = $this->createPermohonan();

        PengajuanKeberatan::create([
            'user_id' => null,
            'nomor_registrasi_permohonan' => $permohonan->nomor_registrasi,
            'alasan_keberatan' => 'Alasan keberatan',
            'jenis_keberatan' => 'Info Ditolak',
            'kasus_posisi' => 'Kasus posisi',
            'status' => 'Menunggu Diproses',
            'tanggal_pengajuan' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Pemohon Tamu');
    }

    private function createPermohonan(array $overrides = []): PermohonanInformasi
    {
        return PermohonanInformasi::create(array_merge([
            'user_id' => null,
            'nomor_registrasi' => 'REG-001',
            'nama_pemohon' => 'Pemohon Tamu',
            'email_pemohon' => 'pemohon@example.com',
            'telp_pemohon' => '081234567890',
            'alamat_pemohon' => 'Alamat Pemohon',
            'jenis_pemohon' => 'Perorangan',
            'pekerjaan_pemohon' => null,
            'identitas_pemohon' => null,
            'rincian_informasi' => 'Rincian informasi',
            'tujuan_penggunaan_informasi' => null,
            'cara_mendapatkan_informasi' => 'Melihat',
            'cara_mendapatkan_salinan' => null,
            'tanggal_permohonan' => now(),
            'status' => 'Menunggu Diproses',
        ], $overrides));
    }
}
