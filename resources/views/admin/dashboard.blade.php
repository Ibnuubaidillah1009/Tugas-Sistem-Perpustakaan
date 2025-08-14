<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6 bg-gradient-to-br from-yellow-400 to-yellow-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    Selamat datang, {{ auth()->user()->name }}!
                </h1>
                <p class="text-gray-600 mb-6">
                    Anda login sebagai 
                    <span class="font-semibold text-yellow-600">{{ ucfirst(auth()->user()->role) }}</span>.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('peminjaman.index') }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded-xl text-center shadow-md">
                        📚 Kelola Peminjaman
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="bg-yellow-400 hover:bg-yellow-500 text-white p-4 rounded-xl text-center shadow-md">
                        👥 Kelola Pengguna
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="bg-yellow-300 hover:bg-yellow-400 text-white p-4 rounded-xl text-center shadow-md">
                        ⚙️ Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>