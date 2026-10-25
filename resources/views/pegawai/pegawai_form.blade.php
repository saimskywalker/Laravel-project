@extends('layouts.app')

@section('title', 'Form Pegawai')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 border-0" style="border-radius: 15px;">
            <h2 class="fw-bold text-dark mb-4 text-center">Form Pegawai</h2>

            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control shadow-sm" id="nama" name="nama"
                        placeholder="Masukkan Nama Lengkap">
                    @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label fw-semibold">NIP</label>
                    <input type="text" class="form-control shadow-sm" id="nip" name="nip"
                        placeholder="Masukkan NIP">
                    @error('nip')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki"
                            value="Laki-laki">
                        <label class="form-check-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                            value="Perempuan">
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                    @error('jenis_kelamin')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                    <input type="text" class="form-control shadow-sm" id="jabatan" name="jabatan"
                        placeholder="Masukkan Jabatan">
                    @error('jabatan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Opd</label><br>
                    @foreach ($opd as $key => $val)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="opd[]" id="dinas_kominfo"
                                value="{{ $key }}">
                            <label class="form-check-label" for="dinas_kominfo">{{ $val }}</label>
                        </div>
                    @endforeach
                    @error('opd')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email"
                        placeholder="Masukkan Email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label fw-semibold">Telepon</label>
                    <input type="text" class="form-control shadow-sm" id="telepon" name="telepon"
                        placeholder="Masukkan Nomor Telepon">
                    @error('telepon')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="aktif" value="1">
                        <label class="form-check-label" for="aktif">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="tidak" value="0">
                        <label class="form-check-label" for="tidak">Tidak Aktif</label>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="keterangan[]" id="tetap"
                            value="Pegawai Tetap">
                        <label class="form-check-label" for="tetap">Pegawai Tetap</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="keterangan[]" id="kontrak"
                            value="Kontrak">
                        <label class="form-check-label" for="kontrak">Kontrak</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="keterangan[]" id="magang"
                            value="Magang">
                        <label class="form-check-label" for="magang">Magang</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="keterangan[]" id="pindahan"
                            value="Pindahan">
                        <label class="form-check-label" for="pindahan">Pindahan</label>
                    </div>
                    @error('keterangan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">Foto Pegawai</label>
                    <input type="file" class="form-control shadow-sm" id="foto" name="foto_pegawai"
                        accept="image/*">
                    @error('foto_pegawai')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sk_pegawai" class="form-label fw-semibold">File SK Pegawai</label>
                    <input type="file" class="form-control shadow-sm" id="sk_pegawai" name="file_sk_pegawai"
                        accept=".pdf,.doc,.docx">
                    @error('file_sk_pegawai')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 shadow-sm"
                    style="border-radius: 8px; font-size: 16px; font-weight: bold; transition: 0.3s;">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>


@endsection
