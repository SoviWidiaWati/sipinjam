<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        // with mengambil data alat sekaligus, supaya tidak ada query berulang
        $peminjaman = Peminjaman::with('alat')
            ->latest('tanggal_pinjam')
            ->latest('id')
            ->paginate(10);

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $alat = Alat::where('stok', '>', 0)->orderBy('nama')->get();
        return view('peminjaman.create', compact('alat'));
    }

    public function store(StorePeminjamanRequest $request)
    {
        $data = $request->validated();
        $alat = Alat::findOrFail($data['alat_id']);

        if ($data['jumlah'] > $alat->stok) {
            return back()->withInput()->withErrors([
                'jumlah' => 'Jumlah melebihi stok yang tersedia, yaitu ' . $alat->stok . '.',
            ]);
        }

        // catat peminjaman dan kurangi stok dalam satu transaksi
        DB::transaction(function () use ($data, $alat) {
            Peminjaman::create($data);
            $alat->decrement('stok', $data['jumlah']);
        });

        return redirect()->route('peminjaman.index')
            ->with('sukses', 'Peminjaman berhasil dicatat.');
    }

    public function kembali(Peminjaman $peminjaman)
    {
        if ($peminjaman->tanggal_kembali === null) {
            DB::transaction(function () use ($peminjaman) {
                $peminjaman->update(['tanggal_kembali' => now()->toDateString()]);
                $peminjaman->alat->increment('stok', $peminjaman->jumlah);
            });
        }

        return redirect()->route('peminjaman.index')
            ->with('sukses', 'Alat berhasil dikembalikan.');
    }
}
