<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 Dashboard Siswa
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-green-400 to-green-100 p-6">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">📚 Dashboard Siswa</h1>
            <p class="text-gray-600 mb-6">Halo, {{ auth()->user()->name }}!  
            Anda login sebagai <span class="font-semibold text-green-600">Siswa</span>.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('peminjaman.siswa.index') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-xl text-center shadow-md">
                    📖 Lihat Peminjaman
                </a>
                <a href="{{ route('peminjaman.siswa.create') }}" class="bg-green-400 hover:bg-green-500 text-white p-4 rounded-xl text-center shadow-md">
                    ➕ Pinjam Buku
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
