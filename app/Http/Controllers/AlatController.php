<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlatRequest;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    // Percobaan 7 + Tantangan 1: daftar alat dengan pencarian nama
    public function index(Request $request)
    {
        // input pencarian divalidasi dulu sebelum dipakai di query
        $data = $request->validate([
            'q' => ['nullable', 'string', 'max:50'],
        ]);
        $q = $data['q'] ?? null;

        $alat = Alat::when($q, fn ($query) => $query->where('nama', 'like', '%' . $q . '%'))
            ->orderBy('kode')
            ->paginate(10)
            ->withQueryString();

        return view('alat.index', compact('alat', 'q'));
    }

    // Percobaan 8: form tambah
    public function create()
    {
        return view('alat.create');
    }

    // Percobaan 8: simpan data baru
    public function store(StoreAlatRequest $request)
    {
        Alat::create($request->validated());
        return redirect()->route('alat.index')
            ->with('sukses', 'Alat berhasil ditambahkan.');
    }

    // Latihan dasar: detail satu alat
    public function show(Alat $alat)
    {
        return view('alat.show', compact('alat'));
    }

    // Percobaan 9: form ubah
    public function edit(Alat $alat)
    {
        return view('alat.edit', compact('alat'));
    }

    // Percobaan 9: simpan perubahan
    public function update(StoreAlatRequest $request, Alat $alat)
    {
        $alat->update($request->validated());
        return redirect()->route('alat.index')
            ->with('sukses', 'Alat berhasil diperbarui.');
    }

    // Percobaan 9: hapus data
    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('alat.index')
            ->with('sukses', 'Alat berhasil dihapus.');
    }
}
