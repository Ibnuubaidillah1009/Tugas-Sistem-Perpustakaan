<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">🛡️ Perizinan Pengembalian Buku (Dengan Denda)</h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen text-gray-800">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif

        <p class="text-sm text-gray-600 mb-4">Daftar ini menampilkan peminjaman yang sudah dikembalikan namun memiliki denda. Admin dapat melepas (menghapus) data setelah pemberian izin.</p>

        <div class="overflow-x-auto mt-2">
            <table class="table-blue bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Tanggal Pinjam</th>
                        <th class="px-4 py-2">Tanggal Pengembalian</th>
                        <th class="px-4 py-2">Jenis Buku</th>
                        <th class="px-4 py-2">Judul Buku</th>
                        <th class="px-4 py-2">Denda</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $item->tanggal_pinjam }}</td>
                        <td class="px-4 py-2">{{ $item->tanggal_pengembalian }}</td>
                        <td class="px-4 py-2">{{ $item->jenis_buku }}</td>
                        <td class="px-4 py-2">{{ $item->judul_buku }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.perizinan.lepas', $item->id) }}" method="POST" onsubmit="return confirm('Yakin melepas data peminjaman ini? Tindakan tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Lepas</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 border border-gray-200 px-4 py-6">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
