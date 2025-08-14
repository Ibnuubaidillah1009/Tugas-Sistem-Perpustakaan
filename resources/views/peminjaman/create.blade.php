<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route(auth()->user() && auth()->user()->role === 'admin' ? 'peminjaman.store' : 'peminjaman.siswa.store') }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                <div>
                    <label class="block">Judul Buku</label>
                    <input type="text" name="judul_buku" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mt-4">
                    <label class="block">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mt-4">
                    <label class="block">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mt-4">
                    <label class="block">Jenis Buku</label>
                    <input type="text" name="jenis_buku" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
