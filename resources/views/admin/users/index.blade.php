<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">👥 Manajemen Pengguna</h2>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-200 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 border border-red-200 rounded">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 px-4 py-2 text-left">Nama</th>
                        <th class="border border-gray-200 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-200 px-4 py-2 text-left">Role</th>
                        <th class="border border-gray-200 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-200 px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-200 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="border border-gray-200 px-4 py-2">
                            @if(($onlineIds[$user->id] ?? false))
                                <span class="inline-flex items-center text-green-700">● Online</span>
                            @else
                                <span class="inline-flex items-center text-gray-600">○ Offline</span>
                            @endif
                        </td>
                        <td class="border border-gray-200 px-4 py-2">
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
                            </form>
                            @else
                                <span class="text-gray-500">Akun sendiri</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
