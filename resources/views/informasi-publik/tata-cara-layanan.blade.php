@extends('layouts.public_app')

@section('title', 'Tata Cara Layanan')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero
    title="Tata Cara Layanan"
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Layanan']
    ]"
/>

{{-- ============================================ --}}
{{-- KONTEN UTAMA (2 Kolom) --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10"
         x-data="{ activeSection: '' }"
         x-init="
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        activeSection = entry.target.id;
                    }
                });
            }, { rootMargin: '-20% 0px -70% 0px' });
            document.querySelectorAll('.tata-cara-section').forEach(s => observer.observe(s));
         ">

        <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">

            {{-- ========================================== --}}
            {{-- SIDEBAR DROPDOWN (Hanya Muncul di Mobile) --}}
            {{-- ========================================== --}}
            <div class="lg:hidden relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open"
                        class="w-full bg-white rounded-xl shadow-sm border border-slate-200 p-3.5 flex items-center justify-between text-sm font-medium text-slate-700">
                    <span class="flex items-center gap-2">
                        <i class="bi bi-list text-base text-hijau-600"></i>
                        Pilih Bagian:
                    </span>
                    <svg class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="absolute left-0 right-0 top-full mt-2 bg-white rounded-xl shadow-lg border border-slate-100 p-2 z-50 space-y-1">

                    <a href="#memperoleh-informasi"
                       @click.prevent="open = false; document.getElementById('memperoleh-informasi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-file-earmark-text text-slate-400"></i> Memperoleh Informasi Publik
                    </a>
                    <a href="#pengajuan-keberatan"
                       @click.prevent="open = false; document.getElementById('pengajuan-keberatan').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-exclamation-circle text-slate-400"></i> Pengajuan Keberatan
                    </a>
                    <a href="#sengketa-informasi"
                       @click.prevent="open = false; document.getElementById('sengketa-informasi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-shield-exclamation text-slate-400"></i> Penyelesaian Sengketa Informasi
                    </a>
                    <a href="#pengaduan-pelanggaran"
                       @click.prevent="open = false; document.getElementById('pengaduan-pelanggaran').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-flag text-slate-400"></i> Pengaduan Pelanggaran Pejabat
                    </a>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- SIDEBAR VERTIKAL (Hanya Muncul di Desktop) --}}
            {{-- ========================================== --}}
            <div class="hidden lg:block w-full lg:w-72 shrink-0">
                <div class="lg:sticky lg:top-24">
                    <nav class="bg-white rounded-2xl shadow-sm border border-slate-100 p-3 flex flex-col gap-1.5">

                        <a href="#memperoleh-informasi"
                           @click.prevent="document.getElementById('memperoleh-informasi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'memperoleh-informasi' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-file-earmark-text text-base"></i>
                            <span>Memperoleh Informasi Publik</span>
                        </a>

                        <a href="#pengajuan-keberatan"
                           @click.prevent="document.getElementById('pengajuan-keberatan').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'pengajuan-keberatan' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-exclamation-circle text-base"></i>
                            <span>Pengajuan Keberatan</span>
                        </a>

                        <a href="#sengketa-informasi"
                           @click.prevent="document.getElementById('sengketa-informasi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'sengketa-informasi' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-shield-exclamation text-base"></i>
                            <span>Penyelesaian Sengketa Informasi</span>
                        </a>

                        <a href="#pengaduan-pelanggaran"
                           @click.prevent="document.getElementById('pengaduan-pelanggaran').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'pengaduan-pelanggaran' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-flag text-base"></i>
                            <span>Pengaduan Pelanggaran Pejabat</span>
                        </a>

                    </nav>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- KOLOM KANAN: ISI KONTEN --}}
            {{-- ========================================== --}}
            <div class="flex-1 min-w-0 space-y-4 md:space-y-6">

                {{-- Bagian 1: Tata Cara Memperoleh Informasi Publik --}}
                <section id="memperoleh-informasi" class="tata-cara-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Tata Cara Memperoleh Informasi Publik
                    </h2>

                    @if(file_exists(public_path('images/infografis-tata-cara-permohonan.png')))
                        <div class="mb-5 bg-slate-50 rounded-xl p-2 md:p-3 border border-slate-100">
                            <img src="{{ asset('images/infografis-tata-cara-permohonan.png') }}" alt="Tata Cara Permohonan Informasi" class="w-full h-auto rounded-lg" loading="lazy">
                        </div>
                    @endif

                    <ol class="space-y-3 list-decimal list-outside pl-5 text-slate-600 text-sm md:text-base leading-relaxed marker:text-hijau-600 marker:font-bold">
                        <li><strong class="text-slate-800">Pemohon Mengajukan Permohonan Informasi</strong> — Pemohon mengajukan permohonan informasi ke PPID melalui berbagai layanan (loket, surat, email, atau online).</li>
                        <li><strong class="text-slate-800">Petugas Pelayanan Informasi Menerima Permohonan</strong> — Petugas Pelayanan Informasi melakukan pemeriksaan awal atas permohonan yang diajukan oleh Pemohon Informasi.</li>
                        <li><strong class="text-slate-800">Pemeriksaan Kelengkapan Permohonan</strong> — Dalam hal berkas permohonan belum memenuhi syarat, Petugas Layanan Informasi mengembalikan berkas permohonan dengan memberikan catatan atas hal-hal yang harus dilengkapi/diperbaiki.</li>
                        <li><strong class="text-slate-800">Permohonan yang Memenuhi Syarat</strong> — Permohonan yang telah memenuhi syarat dicatatkan dalam register permohonan informasi dan diteruskan kepada PPID.</li>
                        <li><strong class="text-slate-800">Pengelolaan Permohonan oleh PPID</strong> — PPID menganalisis berkas permohonan dengan mengacu pada Daftar Informasi Publik (DIP) dan Daftar Informasi yang Dikecualikan (DIK) untuk menentukan jenis informasi.</li>
                        <li><strong class="text-slate-800">Penentuan Status Informasi</strong> — Apabila informasi yang dimohonkan tidak termasuk yang dikecualikan, PPID berkoordinasi dengan PPID Unit terkait untuk menyediakan informasi yang dimohonkan.</li>
                        <li><strong class="text-slate-800">Pemenuhan Informasi oleh PPID</strong> — PPID mempunyai waktu 10 hari kerja untuk memenuhi jawaban permohonan. PPID dapat memperpanjang waktu selama 7 hari kerja dengan membuat surat pemberitahuan berikut alasannya kepada Pemohon.</li>
                        <li><strong class="text-slate-800">Penyampaian Jawaban kepada Pemohon</strong> — PPID menyampaikan surat jawaban berikut informasi yang diminta kepada Petugas Layanan Informasi untuk diteruskan kepada Pemohon.</li>
                        <li><strong class="text-slate-800">Penyampaian Jawaban oleh Petugas Layanan Informasi</strong> — Petugas Layanan Informasi mencatatkan surat jawaban dalam register, menyampaikan informasi kepada Pemohon dan mengarsipkan dokumen sebagai arsip Pengelolaan Dokumen.</li>
                    </ol>
                </section>

                {{-- Bagian 2: Tata Cara Pengajuan Keberatan --}}
                <section id="pengajuan-keberatan" class="tata-cara-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Tata Cara Pengajuan Keberatan
                    </h2>

                    @if(file_exists(public_path('images/infografis-tata-cara-keberatan.png')))
                        <div class="mb-5 bg-slate-50 rounded-xl p-2 md:p-3 border border-slate-100">
                            <img src="{{ asset('images/infografis-tata-cara-keberatan.png') }}" alt="Tata Cara Pengajuan Keberatan" class="w-full h-auto rounded-lg" loading="lazy">
                        </div>
                    @endif

                    <ol class="space-y-3 list-decimal list-outside pl-5 text-slate-600 text-sm md:text-base leading-relaxed marker:text-hijau-600 marker:font-bold">
                        <li><strong class="text-slate-800">Pemohon Mengajukan Permohonan Informasi</strong> — Pemohon mengajukan permohonan informasi ke PPID melalui berbagai layanan (loket, surat, email, atau online).</li>
                        <li><strong class="text-slate-800">Petugas Menerima dan Memeriksa Permohonan</strong> — Petugas Layanan Informasi melakukan pemeriksaan awal atas permohonan yang diajukan oleh Pemohon.</li>
                        <li><strong class="text-slate-800">Pemeriksaan Kelengkapan Permohonan</strong> — Jika berkas permohonan belum memenuhi syarat, petugas akan memberikan catatan atas kekurangan berkas yang harus dilengkapi/diperbaiki.</li>
                        <li><strong class="text-slate-800">Pencatatan Permohonan yang Memenuhi Syarat</strong> — Permohonan yang telah memenuhi syarat dicatatkan dalam register permohonan informasi dan diteruskan kepada PPID.</li>
                        <li><strong class="text-slate-800">Pengelolaan Permohonan oleh PPID</strong> — PPID menganalisis berkas permohonan dengan mengacu pada Daftar Informasi Publik (DIP) dan Daftar Informasi yang Dikecualikan (DIK) untuk menentukan jenis informasi.</li>
                        <li><strong class="text-slate-800">Penentuan Status Informasi</strong> — Jika informasi termasuk yang dikecualikan, PPID berkoordinasi dengan PPID Unit terkait untuk menyiapkan informasi yang dapat diberikan kepada pemohon.</li>
                        <li><strong class="text-slate-800">Penyusunan Jawaban oleh PPID</strong> — PPID memiliki waktu maksimal 10 hari kerja untuk memberikan jawaban. Jika diperlukan, dapat diperpanjang maksimal 7 hari kerja dengan pemberitahuan tertulis kepada pemohon.</li>
                        <li><strong class="text-slate-800">Penyampaian Jawaban kepada Pemohon</strong> — PPID menyampaikan surat jawaban berikut informasi yang diminta kepada Pemohon melalui Petugas Layanan Informasi.</li>
                        <li><strong class="text-slate-800">Penyampaian Jawaban oleh Petugas Layanan Informasi</strong> — Petugas Layanan Informasi mencatatkan surat jawaban dalam register, menyampaikan informasi kepada pemohon dan mengarsipkan dokumen sebagai arsip Pengelolaan Dokumen.</li>
                    </ol>
                </section>

                {{-- Bagian 3: Tata Cara Proses Penyelesaian Sengketa Informasi Publik --}}
                <section id="sengketa-informasi" class="tata-cara-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Tata Cara Proses Penyelesaian Sengketa Informasi Publik
                    </h2>

                    @if(file_exists(public_path('images/infografis-tata-cara-sengketa.png')))
                        <div class="mb-5 bg-slate-50 rounded-xl p-2 md:p-3 border border-slate-100">
                            <img src="{{ asset('images/infografis-tata-cara-sengketa.png') }}" alt="Tata Cara Proses Penyelesaian Sengketa Informasi Publik" class="w-full h-auto rounded-lg" loading="lazy">
                        </div>
                    @endif

                    <ol class="space-y-3 list-decimal list-outside pl-5 text-slate-600 text-sm md:text-base leading-relaxed marker:text-hijau-600 marker:font-bold">
                        <li><strong class="text-slate-800">Pengajuan Permohonan Sengketa</strong> — Apabila tanggapan Atasan PPID atas keberatan dinilai belum memuaskan, pemohon dapat mengajukan permohonan penyelesaian sengketa informasi kepada Komisi Informasi paling lambat 14 (empat belas) hari kerja sejak diterimanya tanggapan tertulis dari Atasan PPID.</li>
                        <li><strong class="text-slate-800">Pemeriksaan dan Penetapan Proses</strong> — Komisi Informasi memeriksa kelengkapan permohonan dan menetapkan proses penyelesaian melalui mediasi dan/atau ajudikasi nonlitigasi.</li>
                        <li><strong class="text-slate-800">Penyelesaian Sengketa oleh Komisi Informasi</strong> — Proses penyelesaian sengketa oleh Komisi Informasi dilakukan paling lambat 100 (seratus) hari kerja sejak diterimanya permohonan.</li>
                        <li><strong class="text-slate-800">Putusan dan Upaya Hukum</strong> — Putusan Komisi Informasi bersifat final dan mengikat bagi para pihak, kecuali salah satu pihak mengajukan keberatan ke Pengadilan Tata Usaha Negara (untuk badan publik negara) atau kasasi ke Mahkamah Agung (untuk badan publik bukan negara) paling lambat 14 (empat belas) hari kerja sejak putusan diterima.</li>
                    </ol>

                    <p class="text-slate-500 text-xs md:text-sm italic mt-6">Informasi lebih lanjut dapat menghubungi PPID IAIN Bone.</p>
                </section>

                {{-- Bagian 4: Tata Cara Pengaduan Penyalahgunaan Wewenang / Pelanggaran Pejabat --}}
                <section id="pengaduan-pelanggaran" class="tata-cara-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Tata Cara Pengaduan Penyalahgunaan Wewenang atau Pelanggaran yang Dilakukan oleh Pejabat Perguruan Tinggi Negeri
                    </h2>

                    <p class="text-slate-600 text-sm md:text-base leading-relaxed mb-6">Pengaduan penyalahgunaan wewenang dapat disampaikan atas dugaan pelanggaran yang dilakukan oleh pejabat di lingkungan IAIN Bone, maupun oleh mitra kerja IAIN Bone, melalui mekanisme berikut.</p>

                    {{-- Sub 1: Pejabat --}}
                    <div class="mb-8">
                        <h3 class="text-base md:text-lg font-bold text-hijau-700 mb-3">Pengaduan Penyalahgunaan Wewenang Pejabat</h3>

                        @if(file_exists(public_path('images/infografis-pengaduan-pejabat.png')))
                            <div class="mb-4 bg-slate-50 rounded-xl p-2 md:p-3 border border-slate-100">
                                <img src="{{ asset('images/infografis-pengaduan-pejabat.png') }}" alt="Tata Cara Pengaduan Penyalahgunaan Wewenang Pejabat" class="w-full h-auto rounded-lg" loading="lazy">
                            </div>
                        @endif

                        <ol class="space-y-3 list-decimal list-outside pl-5 text-slate-600 text-sm md:text-base leading-relaxed marker:text-hijau-600 marker:font-bold">
                            <li><strong class="text-slate-800">Penyampaian Pengaduan</strong> — Pengadu mengadukan penyalahgunaan wewenang pejabat IAIN Bone kepada Rektor IAIN Bone melalui surat, email, atau datang langsung ke layanan pengaduan.</li>
                            <li><strong class="text-slate-800">Penerimaan Tanda Bukti Pengaduan</strong> — Pengadu menerima tanda bukti pengaduan penyalahgunaan wewenang dari petugas di Satuan Pengawasan Internal (SPI) IAIN Bone untuk ditindaklanjuti.</li>
                            <li><strong class="text-slate-800">Pengaduan Melalui Aplikasi Nasional</strong> — Pengadu juga dapat melakukan pengaduan melalui aplikasi pelaporan LAPOR! melalui laman <a href="https://www.lapor.go.id/" target="_blank" rel="noopener" class="text-hijau-700 font-semibold hover:underline">lapor.go.id</a>.</li>
                        </ol>
                    </div>

                    {{-- Sub 2: Mitra Kerja --}}
                    <div>
                        <h3 class="text-base md:text-lg font-bold text-hijau-700 mb-3">Pengaduan Penyalahgunaan Wewenang oleh Mitra Kerja</h3>

                        @if(file_exists(public_path('images/infografis-pengaduan-mitra-kerja.png')))
                            <div class="mb-4 bg-slate-50 rounded-xl p-2 md:p-3 border border-slate-100">
                                <img src="{{ asset('images/infografis-pengaduan-mitra-kerja.png') }}" alt="Tata Cara Pengaduan Penyalahgunaan Wewenang oleh Mitra Kerja IAIN Bone" class="w-full h-auto rounded-lg" loading="lazy">
                            </div>
                        @endif

                        <ol class="space-y-3 list-decimal list-outside pl-5 text-slate-600 text-sm md:text-base leading-relaxed marker:text-hijau-600 marker:font-bold">
                            <li><strong class="text-slate-800">Penyampaian Pengaduan</strong> — Pengadu menyampaikan laporan dugaan penyalahgunaan wewenang oleh mitra kerja IAIN Bone kepada Rektor IAIN Bone melalui surat, email, atau datang langsung ke layanan pengaduan.</li>
                            <li><strong class="text-slate-800">Penerimaan dan Verifikasi Awal</strong> — Petugas atau Satuan Pengawasan Internal (SPI) IAIN Bone menerima pengaduan, melakukan pemeriksaan awal, lalu memberikan tanda bukti penerimaan pengaduan kepada pengadu untuk ditindaklanjuti.</li>
                            <li><strong class="text-slate-800">Pengaduan Melalui Aplikasi Nasional</strong> — Pengadu juga dapat menyampaikan pengaduan melalui aplikasi layanan aspirasi dan pengaduan online rakyat (LAPOR!) melalui laman <a href="https://www.lapor.go.id/" target="_blank" rel="noopener" class="text-hijau-700 font-semibold hover:underline">lapor.go.id</a>.</li>
                        </ol>
                    </div>

                    <p class="text-slate-500 text-xs md:text-sm italic mt-6">Informasi lebih lanjut dapat menghubungi PPID / SPI IAIN Bone.</p>
                </section>

            </div>
        </div>

        {{-- ============================================ --}}
        {{-- TOMBOL AKSI --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10 pt-8 border-t border-slate-200">
            <button onclick="history.back()"
                    class="flex items-center gap-2 px-5 py-2.5 bg-white text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </button>
            <a href="{{ url('/') }}"
               class="flex items-center gap-2 px-5 py-2.5 bg-hijau-600 text-white rounded-xl text-sm font-medium hover:bg-hijau-700 shadow-lg shadow-hijau-600/30 hover:shadow-hijau-600/50 transition-all duration-300 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection
