<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeminjamanBuku extends Model
{
    protected $table = 'peminjaman_buku';

    protected $fillable = [
        'judul_buku',
        'jenis_buku',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'denda',
        'dikembalikan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_pengembalian' => 'date',
        'denda' => 'integer',
        'dikembalikan' => 'boolean',
    ];

    /**
     * Hitung denda otomatis.
     * Aturan:
     * - Tidak ada denda jika durasi pinjam <= 7 hari
     * - Denda mulai dihitung di hari ke-8
     * - Tarif: 2000 per 7 hari (berdasarkan total durasi pinjam). Denda pertama dikenakan pada hari ke-8.
     *   Contoh: pinjam 14 hari => denda 4.000
     */
    public function hitungDenda()
    {
        if (empty($this->tanggal_pinjam) || empty($this->tanggal_pengembalian)) {
            return 0;
        }

        $mulai = Carbon::parse($this->tanggal_pinjam);
        $selesai = Carbon::parse($this->tanggal_pengembalian);
        $durasi = $mulai->diffInDays($selesai, false);

        if ($durasi <= 7) {
            return 0;
        }

        // Denda 2.000 per 7 hari berdasarkan total durasi pinjam.
        // Denda pertama dikenakan pada hari ke-8.
        // Contoh: pinjam 14 hari => denda 4.000
        $minggu = intdiv($durasi, 7);

        return $minggu * 2000;
    }

    /**
     * Tandai peminjaman sebagai dikembalikan dan hitung denda.
     */
    public function kembalikan(): void
    {
        $this->denda = $this->hitungDenda();
        $this->dikembalikan = true;
        $this->save();
    }

    /**
     * Event model: Set denda otomatis saat menyimpan
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Hanya hitung denda saat tanggal_pengembalian ada
            if (!empty($model->tanggal_pengembalian)) {
                $model->denda = $model->hitungDenda();
            }
        });
    }
}