{{-- 
    CATATAN PENTING: 
    File ini HANYA berisi isi konten. 
    Kerangka Modal (tombol X, background gelap) sudah ditangani oleh Alpine.js di file struktur-organisasi.blade.php
--}}
<div class="flex flex-col md:flex-row gap-6 items-center md:items-start">
    
    {{-- KOLOM FOTO --}}
    <div class="w-full md:w-1/3 flex justify-center shrink-0">
        <img src="{{ $pejabat->foto_url }}" 
             alt="Foto {{ $pejabat->nama }}" 
             class="w-full max-w-[200px] h-auto rounded-xl shadow-md object-cover aspect-[3/4]"
             loading="lazy">
    </div>

    {{-- KOLOM TEKS & DESKRIPSI --}}
    <div class="w-full md:w-2/3 text-center md:text-left">
        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $pejabat->nama }}</h3>
        <p class="text-hijau-700 font-semibold mb-4">{{ $pejabat->jabatan }}</p>
        
        <div class="border-t border-gray-100 pt-4">
            @if($pejabat->deskripsi_singkat)
                {{-- 
                    [&_p]:mb-3 adalah trik Tailwind untuk memberi margin bawah 
                    pada tag <p> yang keluar dari WYSIWYG editor (TinyMCE) 
                    agar paragrafnya tidak nempel --}}
                <div class="text-gray-600 text-sm leading-relaxed [&_p]:mb-3">
                    {!! $pejabat->deskripsi_singkat !!}
                </div>
            @else
                <p class="text-gray-400 text-sm italic">Profil lengkap belum tersedia untuk pejabat ini.</p>
            @endif
        </div>
    </div>
</div>