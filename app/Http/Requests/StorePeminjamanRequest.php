<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alat_id'        => ['required', 'exists:alats,id'],
            'nama_peminjam'  => ['required', 'string', 'min:3', 'max:100'],
            'jumlah'         => ['required', 'integer', 'min:1'],
            'tanggal_pinjam' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'alat_id.required'        => 'Alat wajib dipilih.',
            'alat_id.exists'          => 'Alat yang dipilih tidak ditemukan.',
            'nama_peminjam.required'  => 'Nama peminjam wajib diisi.',
            'nama_peminjam.min'       => 'Nama peminjam minimal 3 karakter.',
            'jumlah.required'         => 'Jumlah wajib diisi.',
            'jumlah.integer'          => 'Jumlah harus berupa angka bulat.',
            'jumlah.min'              => 'Jumlah minimal 1.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.date'     => 'Format tanggal pinjam tidak valid.',
        ];
    }
}
