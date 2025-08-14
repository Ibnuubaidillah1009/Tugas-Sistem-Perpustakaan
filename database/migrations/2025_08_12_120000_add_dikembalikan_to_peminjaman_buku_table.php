<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->boolean('dikembalikan')->default(false)->after('denda');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->dropColumn('dikembalikan');
        });
    }
};
