<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">📚 Peminjaman Saya</h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('warning'))
            <div class="mb-4 p-3 rounded bg-yellow-100 text-yellow-800">{{ session('warning') }}</div>
        @endif

        <a href="{{ route('peminjaman.siswa.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            ➕ Tambah Peminjaman
        </a>

        <div class="overflow-x-auto mt-6">
            <table class="w-full border-collapse border border-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 px-4 py-2">Tanggal Pinjam</th>
                        <th class="border border-gray-200 px-4 py-2">Tanggal Pengembalian</th>
                        <th class="border border-gray-200 px-4 py-2">Jenis Buku</th>
                        <th class="border border-gray-200 px-4 py-2">Judul Buku</th>
                        <th class="border border-gray-200 px-4 py-2">Denda</th>
                        <th class="border border-gray-200 px-4 py-2">Status</th>
                        <th class="border border-gray-200 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border border-gray-200 px-4 py-2">{{ $item->tanggal_pinjam }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $item->tanggal_pengembalian }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $item->jenis_buku }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $item->judul_buku }}</td>
                        <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        <td class="border border-gray-200 px-4 py-2">
                            @if($item->dikembalikan)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Dikembalikan</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Dipinjam</span>
                            @endif
                        </td>
                        <td class="border border-gray-200 px-4 py-2">
                            @if(!$item->dikembalikan)
                                <form action="{{ route('peminjaman.siswa.kembalikan', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?');">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Kembalikan</button>
                                </form>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
