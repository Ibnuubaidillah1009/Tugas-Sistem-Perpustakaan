<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Profil Pengguna') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-amber-300 flex items-center justify-center text-xl font-bold">
                        {{ Str::of(auth()->user()->name)->substr(0,1)->upper() }}
                    </div>
                    <div>
                        <div class="text-lg font-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-sm text-gray-600">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div class="space-y-6">
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold mb-3">Informasi Profil</h3>
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold mb-3">Ubah Password</h3>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold mb-3">Hapus Akun</h3>
                            @include('profile.partials.delete-user-form')
                        </div>

                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-semibold mb-3">Ringkasan</h3>
                            <ul class="text-sm list-disc ms-5 space-y-1">
                                <li>Role: <span class="font-medium">{{ ucfirst(auth()->user()->role) }}</span></li>
                                <li>Bergabung: <span class="font-medium">{{ auth()->user()->created_at->format('d M Y') }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
