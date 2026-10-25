<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatePegawaiTest extends TestCase
{
    use RefreshDatabase;

    private function buatPegawai(array $override = []): Pegawai
    {
        return Pegawai::create(array_merge([
            'nama' => 'Budi Santoso',
            'nip' => '199001012020121001',
            'jenis_kelamin' => 'Laki-laki',
            'jabatan' => 'Staf',
            'email' => 'budi@example.com',
            'telepon' => '081234567890',
            'status' => true,
            'keterangan' => 'Pegawai Tetap',
            'foto_pegawai' => 'foto.jpg',
            'file_sk_pegawai' => 'sk.pdf',
        ], $override));
    }

    private function dataUpdate(array $override = []): array
    {
        return array_merge([
            'nama' => 'Budi Santoso, S.Kom',
            'nip' => '199001012020121001',
            'jabatan' => 'Kepala Seksi',
            'email' => 'budi.baru@example.com',
            'telepon' => '081111111111',
            'status' => '0',
        ], $override);
    }

    public function test_form_edit_menampilkan_data_lama(): void
    {
        $pegawai = $this->buatPegawai();

        $this->get(route('pegawai.edit', $pegawai))
            ->assertOk()
            ->assertSee('value="Staf"', false)
            ->assertSee('value="budi@example.com"', false)
            ->assertSee('value="081234567890"', false);
    }

    public function test_data_pegawai_bisa_diperbarui(): void
    {
        $pegawai = $this->buatPegawai();

        $this->put(route('pegawai.update', $pegawai), $this->dataUpdate())
            ->assertRedirect(route('pegawai.index'))
            ->assertSessionHasNoErrors();

        $pegawai->refresh();
        $this->assertSame('Kepala Seksi', $pegawai->jabatan);
        $this->assertSame('budi.baru@example.com', $pegawai->email);
        $this->assertFalse((bool) $pegawai->status);
        $this->assertSame('foto.jpg', $pegawai->foto_pegawai);
    }

    public function test_nip_milik_pegawai_lain_ditolak(): void
    {
        $this->buatPegawai(['nip' => '198501012010011001', 'email' => 'lain@example.com']);
        $pegawai = $this->buatPegawai();

        $this->put(route('pegawai.update', $pegawai), $this->dataUpdate(['nip' => '198501012010011001']))
            ->assertSessionHasErrors('nip');

        $this->assertSame('199001012020121001', $pegawai->refresh()->nip);
    }
}
