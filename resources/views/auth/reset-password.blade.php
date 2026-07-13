<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - {{ $settings['app_name'] ?? 'PPID IAIN BONE' }}</title>

    @if(isset($settings['app_favicon']) && Storage::disk('public')->exists($settings['app_favicon']))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings['app_favicon']) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ showPassword: false, showConfirm: false }">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-hijau-800 via-hijau-900 to-gray-900 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-hijau-600/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-hijau-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-emerald-400/5 rounded-full blur-2xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>

            <div class="relative z-10 flex flex-col justify-center px-16 xl:px-24">
                <div class="mb-10">
                    @php
                        $logoPath = $settings['app_logo'] ?? null;
                        $logoExists = $logoPath && file_exists(public_path('storage/' . $logoPath));
                    @endphp
                    @if($logoExists)
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" class="h-14 w-auto brightness-0 invert mb-6">
                    @else
                        <div class="h-14 w-14 bg-hijau-600/20 border border-hijau-500/30 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-landmark text-2xl text-hijau-400"></i>
                        </div>
                    @endif
                    <h1 class="text-3xl xl:text-4xl font-bold text-white leading-tight">
                        <span class="text-hijau-400">IAIN Bone</span>
                    </h1>
                </div>

                <p class="text-hijau-200/60 text-lg leading-relaxed max-w-md mb-12">
                    Buat password baru yang kuat untuk menjaga keamanan akun Anda.
                </p>

                <div class="space-y-5">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-hijau-600/20 border border-hijau-500/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-lock text-hijau-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Gunakan 8 Karakter</p>
                            <p class="text-hijau-200/50 text-xs">Minimal panjang password yang aman</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-hijau-600/20 border border-hijau-500/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-mix-blend-mode text-hijau-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Campur Huruf & Angka</p>
                            <p class="text-hijau-200/50 text-xs">Contoh: PPID2025!ain</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-hijau-600/20 border border-hijau-500/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-check-double text-hijau-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Konfirmasi Dengan Benar</p>
                            <p class="text-hijau-200/50 text-xs">Ketik ulang password yang sama</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-10 left-16 xl:left-24">
                    <p class="text-hijau-200/30 text-xs">&copy; {{ date('Y') }} PPID IAIN Bone. All rights reserved.</p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10 lg:p-16">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden text-center mb-8">
                    @if($logoExists)
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" class="h-12 w-auto mx-auto mb-4">
                    @else
                        <div class="h-12 w-12 bg-hijau-100 border border-hijau-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-landmark text-xl text-hijau-600"></i>
                        </div>
                    @endif
                    <h2 class="text-xl font-bold text-gray-900">PPID <span class="text-hijau-600">IAN Bone</span></h2>
                </div>

                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-yellow-50 border border-yellow-100 mb-5">
                        <i class="fas fa-key text-yellow-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Atur Ulang Password</h2>
                    <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                        Masukkan password baru Anda di bawah ini.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email', $request->email) }}" 
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-sm placeholder-gray-400 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition @error('email') border-red-400 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input id="password" 
                                   :type="showPassword ? 'text' : 'password'" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   class="w-full pl-11 pr-12 py-3 rounded-xl border border-gray-200 text-sm placeholder-gray-400 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition @error('password') border-red-400 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   placeholder="Minimal 8 karakter">
                            <button type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input id="password_confirmation" 
                                   :type="showConfirm ? 'text' : 'password'" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   class="w-full pl-11 pr-12 py-3 rounded-xl border border-gray-200 text-sm placeholder-gray-400 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition @error('password_confirmation') border-red-400 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   placeholder="Ulangi password baru">
                            <button type="button" 
                                    @click="showConfirm = !showConfirm" 
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas" :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3 px-4 bg-hijau-600 text-white font-semibold rounded-xl hover:bg-hijau-700 focus:outline-none focus:ring-2 focus:ring-hijau-500 focus:ring-offset-2 transition-all duration-200 shadow-lg shadow-hijau-600/20 hover:shadow-xl hover:shadow-hijau-600/30 flex items-center justify-center gap-2">
                        <span>Reset Password</span>
                        <i class="fas fa-check text-sm"></i>
                    </button>
                </form>

                <!-- Back to Home -->
                <div class="text-center mt-8">
                    <a href="{{ url('/') }}" 
                       class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-hijau-600 transition-colors group">
                        <i class="fas fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>

    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>