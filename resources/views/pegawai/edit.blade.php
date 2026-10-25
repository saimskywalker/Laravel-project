@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
    <div class="container">
        <h2 class="fw-bold text-dark">Edit Pegawai</h2>

        <form action="{{ route('pegawai.update', $pegawai) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pegawai->nama) }}" required>
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $pegawai->nip) }}" required>
                @error('nip')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                <input type="text" class="form-control shadow-sm" id="jabatan" name="jabatan"
                    placeholder="Masukkan Jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
                @error('jabatan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control shadow-sm" id="email" name="email"
                    placeholder="Masukkan Email" value="{{ old('email', $pegawai->email) }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label fw-semibold">Telepon</label>
                <input type="text" class="form-control shadow-sm" id="telepon" name="telepon"
                    placeholder="Masukkan Nomor Telepon" value="{{ old('telepon', $pegawai->telepon) }}" required>
                @error('telepon')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="aktif" value="1" required
                        @checked((string) old('status', (int) $pegawai->status) === '1')>
                    <label class="form-check-label" for="aktif">Aktif</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="tidak" value="0" required
                        @checked((string) old('status', (int) $pegawai->status) === '0')>
                    <label class="form-check-label" for="tidak">Tidak Aktif</label>
                </div>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
