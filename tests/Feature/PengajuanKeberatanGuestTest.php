<?php

namespace Tests\Feature;

use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengajuanKeberatanGuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_keberatan_form(): void
    {
        $response = $this->get(route('informasi-publik.keberatan.form'));

        $response->assertOk()
            ->assertSee('Email Pemohon')
            ->assertSee('Tidak perlu membuat akun');
    }

    public function test_guest_can_submit_keberatan_with_matching_email(): void
    {
        $this->createPermohonan();

        $response = $this->post(route('informasi-publik.keberatan.store'), $this->validPayload());

        $response->assertRedirect(route('informasi-publik.keberatan.sukses'))
            ->assertSessionHas('nomor_registrasi_permohonan', 'REG-001');

        $keberatan = PengajuanKeberatan::firstOrFail();

        $this->get(route('informasi-publik.keberatan.sukses'))
            ->assertOk()
            ->assertSee('REG-001');

        $this->assertGuest();
        $this->assertNull($keberatan->user_id);
        $this->assertSame('REG-001', $keberatan->nomor_registrasi_permohonan);
        $this->assertSame('Menunggu Diproses', $keberatan->status);
    }

    public function test_guest_cannot_submit_keberatan_with_wrong_email(): void
    {
        $this->createPermohonan();

        $response = $this->from(route('informasi-publik.keberatan.form'))
            ->post(route('informasi-publik.keberatan.store'), $this->validPayload([
                'email_pemohon' => 'salah@example.com',
            ]));

        $response->assertRedirect(route('informasi-publik.keberatan.form'))
            ->assertSessionHasErrors('nomor_registrasi_permohonan');

        $this->assertDatabaseCount('pengajuan_keberatan', 0);
    }

    public function test_authenticated_owner_can_submit_keberatan_with_different_email(): void
    {
        $user = User::factory()->create([
            'email' => 'owner@example.com',
        ]);

        $this->createPermohonan([
            'user_id' => $user->id,
            'nama_pemohon' => null,
            'email_pemohon' => null,
            'telp_pemohon' => null,
            'alamat_pemohon' => null,
        ]);

        $response = $this->actingAs($user)->post(route('informasi-publik.keberatan.store'), $this->validPayload([
            'email_pemohon' => 'email-lain@example.com',
        ]));

        $response->assertRedirect(route('informasi-publik.keberatan.sukses'));

        $keberatan = PengajuanKeberatan::firstOrFail();

        $this->assertSame($user->id, $keberatan->user_id);
        $this->assertSame('REG-001', $keberatan->nomor_registrasi_permohonan);
    }

    public function test_authenticated_non_owner_cannot_submit_keberatan_with_wrong_email(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->createPermohonan([
            'user_id' => $owner->id,
            'nama_pemohon' => null,
            'email_pemohon' => null,
            'telp_pemohon' => null,
            'alamat_pemohon' => null,
        ]);

        $response = $this->actingAs($otherUser)->post(route('informasi-publik.keberatan.store'), $this->validPayload([
            'email_pemohon' => 'email-lain@example.com',
        ]));

        $response->assertSessionHasErrors('nomor_registrasi_permohonan');

        $this->assertDatabaseCount('pengajuan_keberatan', 0);
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

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nomor_registrasi_permohonan' => 'REG-001',
            'email_pemohon' => 'pemohon@example.com',
            'alasan_keberatan' => 'Alasan pengajuan keberatan',
            'jenis_keberatan' => 'Info Ditolak',
            'kasus_posisi' => 'Kasus posisi',
        ], $overrides);
    }
}
