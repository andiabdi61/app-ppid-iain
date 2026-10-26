<?php

namespace Tests\Feature;

use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CekStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_cek_status_page(): void
    {
        $response = $this->get(route('layanan-pengaduan.cek-status'));

        $response->assertOk()
            ->assertSee('Cek Status Layanan')
            ->assertSee('Nomor Registrasi')
            ->assertSee('Email Pemohon');
    }

    public function test_guest_can_see_status_with_matching_number_and_email(): void
    {
        $this->createPermohonan();

        $response = $this->post(route('layanan-pengaduan.cek-status.process'), [
            'nomor_registrasi' => 'REG-001',
            'email' => 'pemohon@example.com',
        ]);

        $response->assertOk()
            ->assertSee('REG-001')
            ->assertSee('Diproses')
            ->assertDontSee(route('informasi-publik.keberatan.form', ['no_reg' => 'REG-001']), false)
            ->assertDontSee('Rincian rahasia')
            ->assertDontSee('Alamat rahasia')
            ->assertDontSee('Catatan rahasia');
    }

    public function test_rejected_permohonan_shows_keberatan_button_and_prefills_form(): void
    {
        $this->createPermohonan([
            'status' => 'Ditolak',
        ]);

        $response = $this->post(route('layanan-pengaduan.cek-status.process'), [
            'nomor_registrasi' => 'REG-001',
            'email' => 'pemohon@example.com',
        ]);

        $response->assertOk()
            ->assertSee('Permohonan Ditolak')
            ->assertSee(route('informasi-publik.keberatan.form', ['no_reg' => 'REG-001']), false);

        $this->get(route('informasi-publik.keberatan.form', ['no_reg' => 'REG-001']))
            ->assertOk()
            ->assertSee('value="REG-001"', false)
            ->assertSee('value="pemohon@example.com"', false);
    }

    public function test_guest_cannot_see_status_with_wrong_email(): void
    {
        $this->createPermohonan();

        $response = $this->post(route('layanan-pengaduan.cek-status.process'), [
            'nomor_registrasi' => 'REG-001',
            'email' => 'salah@example.com',
        ]);

        $response->assertOk()
            ->assertSee('Data tidak ditemukan atau email tidak sesuai dengan permohonan.')
            ->assertDontSee('Rincian rahasia')
            ->assertDontSee('Catatan rahasia');
    }

    public function test_unknown_number_returns_generic_message(): void
    {
        $response = $this->post(route('layanan-pengaduan.cek-status.process'), [
            'nomor_registrasi' => 'TIDAK-ADA',
            'email' => 'pemohon@example.com',
        ]);

        $response->assertOk()
            ->assertSee('Data tidak ditemukan atau email tidak sesuai dengan permohonan.');
    }

    public function test_authenticated_owner_can_see_status_with_different_email(): void
    {
        $user = User::factory()->create(['email' => 'owner@example.com']);

        $this->createPermohonan([
            'user_id' => $user->id,
            'nama_pemohon' => null,
            'email_pemohon' => null,
            'telp_pemohon' => null,
            'alamat_pemohon' => null,
        ]);

        $response = $this->actingAs($user)->post(route('layanan-pengaduan.cek-status.process'), [
            'nomor_registrasi' => 'REG-001',
            'email' => 'email-lain@example.com',
        ]);

        $response->assertOk()
            ->assertSee('REG-001')
            ->assertSee('Diproses');
    }

    public function test_status_page_shows_keberatan_history_without_sensitive_details(): void
    {
        $this->createPermohonan();

        PengajuanKeberatan::create([
            'user_id' => null,
            'nomor_registrasi_permohonan' => 'REG-001',
            'alasan_keberatan' => 'Alasan rahasia',
            'jenis_keberatan' => 'Info Ditolak',
            'kasus_posisi' => 'Kasus posisi rahasia',
            'status' => 'Ditolak',
            'tanggal_pengajuan' => now(),
        ]);

        $response = $this->post(route('layanan-pengaduan.cek-status.process'), [
            'nomor_registrasi' => 'REG-001',
            'email' => 'pemohon@example.com',
        ]);

        $response->assertOk()
            ->assertSee('Pengajuan Keberatan')
            ->assertSee('Ditolak')
            ->assertDontSee('Info Ditolak')
            ->assertDontSee('Alasan rahasia')
            ->assertDontSee('Kasus posisi rahasia');
    }

    private function createPermohonan(array $overrides = []): PermohonanInformasi
    {
        return PermohonanInformasi::create(array_merge([
            'user_id' => null,
            'nomor_registrasi' => 'REG-001',
            'nama_pemohon' => 'Pemohon Tamu',
            'email_pemohon' => 'pemohon@example.com',
            'telp_pemohon' => '081234567890',
            'alamat_pemohon' => 'Alamat rahasia',
            'jenis_pemohon' => 'Perorangan',
            'pekerjaan_pemohon' => null,
            'identitas_pemohon' => null,
            'rincian_informasi' => 'Rincian rahasia',
            'tujuan_penggunaan_informasi' => null,
            'cara_mendapatkan_informasi' => 'Melihat',
            'cara_mendapatkan_salinan' => null,
            'tanggal_permohonan' => now(),
            'status' => 'Diproses',
            'catatan_admin' => 'Catatan rahasia',
        ], $overrides));
    }
}
