<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">📚 Daftar Peminjaman Buku</h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen text-gray-800">
        <a href="{{ route('peminjaman.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            ➕ Tambah Peminjaman
        </a>

        <div class="overflow-x-auto mt-6">
            <table class="w-full border-collapse border border-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700">Tanggal Pinjam</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700">Tanggal Pengembalian</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700">Jenis Buku</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700">Judul Buku</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700">Denda</th>
                        <th class="border border-gray-200 px-4 py-2 text-gray-700">Aksi</th>
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
                        <td class="border border-gray-200 px-4 py-2 space-x-2">
                            <a href="{{ route('peminjaman.edit', $item->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">✏️ Edit</a>
                            <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="inline-block ml-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>