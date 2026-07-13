{{-- Tentukan margin kiri berdasarkan kedalaman nested komentar --}}
@php
    $indent = $depth > 0 ? 'ml-8 sm:ml-12 border-l-2 border-hijau-200 pl-4' : '';
@endphp

<div x-data="{ showReplyForm: false }" class="{{ $indent }} py-4">
    <div class="flex gap-3">
        
        {{-- Avatar --}}
        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name ?? $comment->name) }}&background=16a34a&color=ffffff&rounded=true&bold=true" 
             width="40" height="40" alt="Avatar" class="w-10 h-10 rounded-full object-cover shrink-0 mt-0.5">

        {{-- Konten Komentar --}}
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2 mb-1.5">
                <h6 class="text-sm font-bold text-gray-800">{{ $comment->user->name ?? $comment->name }}</h6>
                @if($depth < 2)
                    <button @click="showReplyForm = !showReplyForm" 
                            class="text-xs font-medium text-hijau-600 hover:text-hijau-700 transition">
                        <i class="bi bi-reply-fill"></i> Balas
                    </button>
                @endif
            </div>

            {{-- Isi Komentar --}}
            <div class="p-3 bg-gray-50 rounded-lg text-sm text-gray-700 leading-relaxed mb-2">
                {!! nl2br(e($comment->content)) !!}
            </div>

            {{-- Meta: Waktu --}}
            <div class="text-xs text-gray-400 flex items-center gap-3">
                <span class="flex items-center gap-1">
                    <i class="bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>

            {{-- ============================================ --}}
            {{-- FORM BALASAN (Hanya tampil jika depth < 2) --}}
            {{-- ============================================ --}}
            @if($depth < 2)
            <div x-show="showReplyForm" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="mt-3">
                <form action="{{ route('comments.store') }}" method="POST" class="space-y-2">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    
                    @guest
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <input type="text" name="name" required placeholder="Nama Anda *" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition">
                        <input type="email" name="email" required placeholder="Email Anda *" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition">
                    </div>
                    @endguest
                    
                    <textarea name="content" rows="2" required placeholder="Tulis balasan Anda..." 
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition resize-none"></textarea>
                    
                    <div class="flex gap-2">
                        <button type="submit" class="bg-hijau-600 hover:bg-hijau-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            <i class="bi bi-send me-1"></i> Kirim
                        </button>
                        <button type="button" @click="showReplyForm = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- REKURSIF: TAMPILKAN BALASAN --}}
    {{-- ============================================ --}}
    @foreach($comment->replies as $reply)
        @include('berita.partials.comment', ['comment' => $reply, 'post' => $post, 'depth' => $depth + 1])
    @endforeach
</div>