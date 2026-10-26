<?php

namespace Tests\Feature;

use App\Models\PermohonanInformasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermohonanInformasiGuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_permohonan_form(): void
    {
        $response = $this->get(route('informasi-publik.permohonan.form'));

        $response->assertOk()
            ->assertSee('Data Pemohon')
            ->assertSee('Tidak perlu membuat akun');
    }

    public function test_guest_can_submit_permohonan_without_account(): void
    {
        $response = $this->post(route('informasi-publik.permohonan.store'), $this->validPayload());

        $response->assertRedirect(route('informasi-publik.permohonan.sukses'))
            ->assertSessionHas('nomor_registrasi');

        $permohonan = PermohonanInformasi::firstOrFail();

        $this->get(route('informasi-publik.permohonan.sukses'))
            ->assertOk()
            ->assertSee($permohonan->nomor_registrasi);

        $this->assertGuest();
        $this->assertNull($permohonan->user_id);
        $this->assertSame('Pemohon Tamu', $permohonan->nama_pemohon_display);
        $this->assertSame('pemohon@example.com', $permohonan->email_pemohon_display);
        $this->assertSame('081234567890', $permohonan->telp_pemohon_display);
        $this->assertSame('Alamat Pemohon', $permohonan->alamat_pemohon_display);
        $this->assertSame('Menunggu Diproses', $permohonan->status);
    }

    public function test_guest_permohonan_requires_contact_data(): void
    {
        $payload = $this->validPayload();
        unset($payload['nama_pemohon'], $payload['email_pemohon'], $payload['telp_pemohon'], $payload['alamat_pemohon']);

        $response = $this->from(route('informasi-publik.permohonan.form'))
            ->post(route('informasi-publik.permohonan.store'), $payload);

        $response->assertRedirect(route('informasi-publik.permohonan.form'))
            ->assertSessionHasErrors([
                'nama_pemohon',
                'email_pemohon',
                'telp_pemohon',
                'alamat_pemohon',
            ]);

        $this->assertDatabaseCount('permohonan_informasi', 0);
    }

    public function test_authenticated_user_permohonan_uses_profile_data(): void
    {
        $user = User::factory()->create([
            'name' => 'User Login',
            'email' => 'login@example.com',
            'telp' => '081200000000',
            'alamat' => 'Alamat Profil',
        ]);

        $payload = $this->validPayload([
            'nama_pemohon' => 'Nama dari Form',
            'email_pemohon' => 'form@example.com',
            'telp_pemohon' => '089999999999',
            'alamat_pemohon' => 'Alamat dari Form',
        ]);

        $response = $this->actingAs($user)->post(route('informasi-publik.permohonan.store'), $payload);

        $response->assertRedirect(route('informasi-publik.permohonan.sukses'));

        $permohonan = PermohonanInformasi::firstOrFail();

        $this->assertSame($user->id, $permohonan->user_id);
        $this->assertSame('User Login', $permohonan->nama_pemohon_display);
        $this->assertSame('login@example.com', $permohonan->email_pemohon_display);
        $this->assertSame('081200000000', $permohonan->telp_pemohon_display);
        $this->assertSame('Alamat Profil', $permohonan->alamat_pemohon_display);
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nama_pemohon' => 'Pemohon Tamu',
            'email_pemohon' => 'pemohon@example.com',
            'telp_pemohon' => '081234567890',
            'alamat_pemohon' => 'Alamat Pemohon',
            'jenis_pemohon' => 'Perorangan',
            'pekerjaan_pemohon' => 'Karyawan',
            'tujuan_penggunaan_informasi' => 'Kebutuhan penelitian',
            'rincian_informasi' => 'Rincian informasi yang dimohonkan',
            'cara_mendapatkan_informasi' => 'Melihat',
            'cara_mendapatkan_salinan' => 'Mengambil Langsung',
        ], $overrides);
    }
}
