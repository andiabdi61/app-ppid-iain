<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Email - {{ $settings['app_name'] ?? 'PPID IAIN BONE' }}</title>

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
<body class="font-sans antialiased bg-gray-50">

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
                    Satu langkah lagi untuk mengaktifkan akun Anda dan mulai mengakses layanan informasi publik.
                </p>

                <div class="space-y-5">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-hijau-600/20 border border-hijau-500/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-shield-alt text-hijau-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Keamanan Terjamin</p>
                            <p class="text-hijau-200/50 text-xs">Verifikasi melindungi akun Anda</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-hijau-600/20 border border-hijau-500/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-bolt text-hijau-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Proses Cepat</p>
                            <p class="text-hijau-200/50 text-xs">Hanya butuh 1 klik untuk verifikasi</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-hijau-600/20 border border-hijau-500/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-unlock-alt text-hijau-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Akses Penuh</p>
                            <p class="text-hijau-200/50 text-xs">Ajukan permohonan setelah verifikasi</p>
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

                @if (session('status') == 'verification-link-sent')
                    <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6 text-sm flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-0.5 shrink-0"></i>
                        <div>
                            <p class="font-semibold">Link Berhasil Dikirim!</p>
                            <p class="text-green-600 mt-0.5">Kami telah mengirim link verifikasi baru ke email Anda.</p>
                        </div>
                    </div>
                @endif

                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 mb-5">
                        <i class="fas fa-envelope-open-text text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email</h2>
                    <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan.
                    </p>
                    <p class="text-gray-400 mt-3 text-sm">
                        Tidak menerima email? Kirim ulang tautannya.
                    </p>
                </div>

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full py-3 px-4 bg-hijau-600 text-white font-semibold rounded-xl hover:bg-hijau-700 focus:outline-none focus:ring-2 focus:ring-hijau-500 focus:ring-offset-2 transition-all duration-200 shadow-lg shadow-hijau-600/20 hover:shadow-xl hover:shadow-hijau-600/30 flex items-center justify-center gap-2">
                            <span>Kirim Ulang Verifikasi Email</span>
                            <i class="fas fa-redo text-sm"></i>
                        </button>
                    </form>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-gray-50 text-gray-400">atau</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full py-3 px-4 bg-white text-gray-600 font-medium rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>

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
</body>
</html>