<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorePegawaiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        DB::table('opd')->insert([
            ['id' => 1, 'nama' => 'dinas kesehatan'],
            ['id' => 2, 'nama' => 'dinas p3a'],
        ]);
    }

    private function dataValid(array $override = []): array
    {
        return array_merge([
            'nama' => 'Budi Santoso',
            'nip' => '199001012020121001',
            'jenis_kelamin' => 'Laki-laki',
            'jabatan' => 'Staf',
            'opd' => [1, 2],
            'email' => 'budi@example.com',
            'telepon' => '081234567890',
            'status' => '1',
            'keterangan' => ['Pegawai Tetap', 'Pindahan'],
            'foto_pegawai' => UploadedFile::fake()->image('foto.jpg'),
            'file_sk_pegawai' => UploadedFile::fake()->create('sk.pdf', 100, 'application/pdf'),
        ], $override);
    }

    public function test_pegawai_baru_tersimpan_beserta_file_dan_opd(): void
    {
        $response = $this->post('/pegawai', $this->dataValid());

        $response->assertRedirect('/pegawai');
        $response->assertSessionHasNoErrors();

        $pegawai = Pegawai::where('nip', '199001012020121001')->firstOrFail();
        $this->assertSame('Pegawai Tetap,Pindahan', $pegawai->keterangan);
        $this->assertSame(2, DB::table('pegawai_opd')->where('pegawai_id', $pegawai->id)->count());

        Storage::disk('local')->assertExists('uploads/foto_pegawai/' . $pegawai->foto_pegawai);
        Storage::disk('local')->assertExists('uploads/file_sk_pegawai/' . $pegawai->file_sk_pegawai);
    }

    public function test_keterangan_boleh_kosong(): void
    {
        $data = $this->dataValid();
        unset($data['keterangan']);

        $this->post('/pegawai', $data)->assertRedirect('/pegawai');

        $this->assertNull(Pegawai::first()->keterangan);
    }

    public function test_file_sk_wajib_diisi(): void
    {
        $data = $this->dataValid();
        unset($data['file_sk_pegawai']);

        $this->post('/pegawai', $data)->assertSessionHasErrors('file_sk_pegawai');

        $this->assertSame(0, Pegawai::count());
    }
}
