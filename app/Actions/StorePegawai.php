<?php

namespace App\Actions;

use App\Models\Pegawai;
use App\Models\PegawaiOpd;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StorePegawai
{
    function handle($request)
    {
        // dd($request);
        $pegawai = $this->pegawai($request);
        $this->riwayatOpd($request, $pegawai);
        // dd('aaaa');

        return redirect('/pegawai')->with('sukses', 'pegawai berhasil ditambahkan');
    }


    private function pegawai($request)
    {

        // dd($request->file('foto_pegawai'));


        // $request->file('avatar')->storeAs(
        //     'avatars',
        //     $request->user()->id
        // );

        // dd($request->foto_pegawai);
        // dd($request->file_sk_pegawai);
        $timestamp = Carbon::now()->format('Ymd_His'); // Format: YYYYMMDD_HHMMSS

        $filenamefoto = $timestamp . '_' . uniqid() . '.' . $request->foto_pegawai->extension();

        // $request->foto_pegawai->storeAs(
        //     'foto_pegawai',
        //     $filenamefoto
        // );

        // Storage::putFileAs(
        //     'uploads/foto_pegawai/', $request->file('foto_pegawai'), $request->user()->id
        // );
        // dd($filenamefoto);

        $request->file('foto_pegawai')->storeAs('uploads/foto_pegawai/', $filenamefoto);

        $filenameSK = $timestamp . '_' . uniqid() . '.' . $request->file_sk_pegawai->extension();

        $request->file('file_sk_pegawai')->storeAs('uploads/file_sk_pegawai/', $filenameSK);

        return Pegawai::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'status' => $request->status,
            'keterangan' => $request->filled('keterangan') ? implode(',', $request->keterangan) : null,
            'foto_pegawai' => $filenamefoto,
            'file_sk_pegawai' => $filenameSK,
        ]);
    }

    private function riwayatOpd($request, $pegawai)
    {
        foreach ($request->opd as $opdId) {
            PegawaiOpd::create([
                'pegawai_id' => $pegawai->id,
                'opd_id' => $opdId
            ]);
        }
    }
}
