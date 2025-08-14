<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman_buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('jenis_buku');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_pengembalian');
            $table->integer('denda')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_buku');
    }
};