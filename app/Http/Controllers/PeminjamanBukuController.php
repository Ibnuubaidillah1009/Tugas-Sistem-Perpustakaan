<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanBukuController extends Controller
{
    /**
     * Menampilkan semua data peminjaman buku
     */
    public function index()
    {
        $peminjaman = PeminjamanBuku::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Form tambah data
     */
    public function create()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('peminjaman.create');
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'jenis_buku' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        PeminjamanBuku::create($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Form edit data
     */
    public function edit($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        $peminjaman = PeminjamanBuku::findOrFail($id);
        return view('peminjaman.edit', compact('peminjaman'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'jenis_buku' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $peminjaman = PeminjamanBuku::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        $peminjaman = PeminjamanBuku::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil dihapus');
    }

    /**
     * ADMIN: Perizinan pengembalian - daftar peminjaman dengan denda > 0 atau status dikembalikan dengan denda
     */
    public function perizinanIndex()
    {
        $list = PeminjamanBuku::where('dikembalikan', true)
            ->where('denda', '>', 0)
            ->orderByDesc('updated_at')
            ->get();
        return view('admin.perizinan_pengembalian', compact('list'));
    }

    /**
     * ADMIN: Lepas data peminjaman (hapus) setelah izin
     */
    public function perizinanLepas($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('admin.perizinan.index')->with('success', 'Data peminjaman telah dilepas.');
    }

    /**
     * SISWA: Menampilkan daftar peminjaman (sementara menampilkan semua karena belum ada relasi user_id)
     */
    public function indexSiswa()
    {
        $peminjaman = PeminjamanBuku::all();
        return view('peminjaman.index_siswa', compact('peminjaman'));
    }

    /**
     * SISWA: Kembalikan buku
     */
    public function kembalikanSiswa($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Set tanggal pengembalian ke hari ini jika belum diset
        if (empty($peminjaman->tanggal_pengembalian)) {
            $peminjaman->tanggal_pengembalian = Carbon::today();
        }

        // Hitung denda dan tandai dikembalikan
        $peminjaman->kembalikan();

        if ($peminjaman->denda > 0) {
            return redirect()->route('peminjaman.siswa.index')
                ->with('warning', 'Anda terkena denda. Silakan minta izin ke admin untuk melepas data peminjaman.');
        }

        return redirect()->route('peminjaman.siswa.index')
            ->with('success', 'Anda sudah mengembalikan buku.');
    }

    /**
     * SISWA: Form tambah peminjaman
     */
    public function createSiswa()
    {
        return view('peminjaman.create');
    }

    /**
     * SISWA: Simpan peminjaman
     */
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'jenis_buku' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        PeminjamanBuku::create($request->all());

        return redirect()->route('peminjaman.siswa.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }
}