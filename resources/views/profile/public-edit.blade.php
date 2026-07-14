@extends('layouts.public_app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        {{-- NOTIFIKASI SUKSES --}}
        @if (session('status') === 'profile-updated')
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg"></i>
                <p class="text-sm font-medium">Profil Anda berhasil diperbarui.</p>
            </div>
        @endif
        @if (session('status') === 'password-updated')
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg"></i>
                <p class="text-sm font-medium">Kata sandi Anda berhasil diubah.</p>
            </div>
        @endif

        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">Pengaturan Akun</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- ==================== KOLOM KIRI ==================== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- FORM UPDATE INFORMASI PROFIL --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                            <i class="fa-solid fa-user-pen text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm">Informasi Profil</h3>
                            <p class="text-xs text-gray-400">Perbarui informasi profil dan data kontak Anda.</p>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <input type="hidden" name="source" value="public">

                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input id="name" name="name" type="text" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm" 
                                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                    <input id="email" name="email" type="email" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm" 
                                           value="{{ old('email', $user->email) }}" required autocomplete="username">
                                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <input id="telp" name="telp" type="text" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm" 
                                           value="{{ old('telp', $user->telp) }}" autocomplete="tel">
                                    @error('telp')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="3" 
                                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm">{{ old('alamat', $user->alamat) }}</textarea>
                                    @error('alamat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="px-6 py-2.5 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- FORM UPDATE PASSWORD --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showPw: false }">
                    <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm">Ubah Kata Sandi</h3>
                                <p class="text-xs text-gray-400">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak.</p>
                            </div>
                        </div>
                        <button type="button" @click="showPw = !showPw" class="text-xs font-semibold text-hijau-600 hover:text-hijau-700 flex items-center gap-1">
                            <span x-text="showPw ? 'Tutup' : 'Buka Form'"></span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="showPw && 'rotate-180'"></i>
                        </button>
                    </div>
                    
                    <div x-show="showPw" x-collapse x-cloak class="p-6 border-t border-gray-100">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="source" value="public">

                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Saat Ini</label>
                                    <input id="current_password" name="current_password" type="password" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm" 
                                           autocomplete="current-password" required>
                                    @error('current_password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                                    <input id="password" name="password" type="password" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm" 
                                           autocomplete="new-password" required>
                                    @error('password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm" 
                                           autocomplete="new-password" required>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="px-6 py-2.5 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm">
                                    Simpan Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ==================== KOLOM KANAN: HAPUS AKUN ==================== --}}
            <div class="lg:col-span-1" x-data="{ showDeleteModal: false }">
                <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden sticky top-24">
                    <div class="px-5 py-4 bg-red-50 border-b border-red-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                            <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                        </div>
                        <h3 class="font-bold text-red-800 text-sm">Zona Berbahaya</h3>
                    </div>
                    
                    <div class="p-5">
                        <p class="text-sm text-gray-600 mb-5">Setelah akun Anda dihapus, semua data riwayat permohonan dan profil akan dihapus secara permanen.</p>
                        
                        <button @click="showDeleteModal = true" 
                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 rounded-lg text-sm font-semibold transition-colors">
                            <i class="fa-solid fa-trash text-xs"></i> Hapus Akun
                        </button>
                    </div>
                </div>

                {{-- MODAL KONFIRMASI HAPUS (Menggunakan Alpine.js) --}}
                <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showDeleteModal = false"></div>
                        
                        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            
                            <form method="post" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')
                                
                                <div class="bg-white px-6 pt-6 pb-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-bold text-gray-900">Apakah Anda yakin?</h3>
                                        <button type="button" @click="showDeleteModal = false" class="text-gray-400 hover:text-gray-600">
                                            <i class="fa-solid fa-xmark text-xl"></i>
                                        </button>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-4">Setelah akun Anda dihapus, semua datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi.</p>
                                    
                                    <div>
                                        <label for="password-delete" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                                        <input id="password-delete" name="password" type="password" 
                                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm" 
                                               placeholder="Masukkan kata sandi" required>
                                        @error('password', 'userDeletion')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6 gap-3">
                                    <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2.5 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm transition">
                                        Hapus Akun Permanen
                                    </button>
                                    <button type="button" @click="showDeleteModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection