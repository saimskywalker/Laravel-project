<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nama'  => 'required',
            'nip'  => 'required',
            'jenis_kelamin'  => 'required',
            'jabatan'  => 'required',
            'opd'  => 'required',
            'email'  => 'required',
            'telepon'  => 'required',
            'status' => 'required',
            'keterangan' => 'nullable|array',
            'foto_pegawai' => 'required',
            'file_sk_pegawai' => 'required',
        ];
    }
}
