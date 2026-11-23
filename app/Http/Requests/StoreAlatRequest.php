<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAlatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // null saat tambah data, berisi model Alat saat ubah data
        $id = $this->route('alat')?->id;

        return [
            'kode' => [
                'required', 'string', 'max:20',
                Rule::unique('alats', 'kode')->ignore($id),
            ],
            'nama'    => ['required', 'string', 'min:3', 'max:100'],
            'stok'    => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', 'in:baik,rusak ringan,rusak berat'],
            'lokasi'  => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required'    => 'Kode alat wajib diisi.',
            'kode.unique'      => 'Kode alat sudah dipakai.',
            'nama.required'    => 'Nama alat wajib diisi.',
            'nama.min'         => 'Nama alat minimal 3 karakter.',
            'stok.required'    => 'Stok wajib diisi.',
            'stok.integer'     => 'Stok harus berupa angka bulat.',
            'stok.min'         => 'Stok tidak boleh negatif.',
            'kondisi.required' => 'Kondisi alat wajib dipilih.',
            'kondisi.in'       => 'Kondisi alat tidak valid.',
        ];
    }
}
