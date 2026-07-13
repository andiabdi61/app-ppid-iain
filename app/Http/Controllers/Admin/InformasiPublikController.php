<?php

namespace App\Http\Controllers\Admin;

use App\Models\InformasiPublik;
use App\Models\InformasiPublikCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class InformasiPublikController extends Controller
{
    /**
     * INDEX (Draft awal, akan kita lengkapi nanti di step view)
     */
       public function index(Request $request)
    {
        Gate::authorize('viewAny', InformasiPublik::class);
        
        $categories = InformasiPublikCategory::orderBy('nama')->get(); // DITAMBAHKAN UNTUK DROPDOWN FILTER

        // Query dengan Join agar bisa mengurutkan berdasarkan Nama Kategori
        $query = InformasiPublik::with('category')
            ->leftJoin('informasi_publik_categories', 'informasi_publik.category_id', '=', 'informasi_publik_categories.id')
            ->whereNull('informasi_publik.parent_id')
            ->select('informasi_publik.*');

        // LOGIC FILTER KATEGORI
        if ($request->filled('filter_category')) {
            $query->where('informasi_publik.category_id', $request->filter_category);
        }

        $informasiPublik = $query->orderBy('informasi_publik_categories.nama', 'asc')
                                 ->orderBy('informasi_publik.sort_order', 'asc')
                                 ->paginate(20)
                                 ->appends(request()->query()); // Agar pagination membawa data filter

        return view('admin.informasi-publik.index', compact('informasiPublik', 'categories'));
    }

    /**
     * CREATE - Menampilkan form Tambah Judul Utama
     */
    public function create()
    {
        Gate::authorize('create', InformasiPublik::class);
        
        $categories = InformasiPublikCategory::orderBy('sort_order')->orderBy('nama')->get();

        return view('admin.informasi-publik.create', compact('categories'));
    }

    /**
     * STORE - Menyimpan Judul Utama
     */
    public function store(Request $request)
    {
        Gate::authorize('create', InformasiPublik::class);

        // Validasi sesuai kebutuhan form Judul Utama
        $validated = $request->validate([
            'judul'             => 'required|string|max:255|unique:informasi_publik,judul',
            'category_id'       => 'required|exists:informasi_publik_categories,id',
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
        ]);

        // Inisialisasi variabel file
        $filePath = null;
        $fileNama = null;
        $fileTipe = null;

        // Proses upload file jika admin mengisinya
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filePath = $file->store('informasi_publik/dokumen', 'public');
            $fileNama = $file->getClientOriginalName();
            $fileTipe = $file->getClientOriginalExtension();
        }

        // Buat slug yang unik
        $slug = Str::slug($validated['judul']);
        $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->count();
        if ($slugCount > 0) {
            $slug .= '-' . ($slugCount + 1);
        }

        // Simpan ke database
        InformasiPublik::create([
            'judul'             => $validated['judul'],
            'slug'              => $slug,
            'category_id'       => $validated['category_id'],
            'parent_id'         => null, // Wajib null karena ini Judul Utama
            'konten'            => '',   // Diisi string kosong agar tidak error SQL 1364
            'file_path'         => $filePath,
            'file_nama'         => $fileNama,
            'file_tipe'         => $fileTipe,
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?? now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
        ]);

        // Hapus cache jika ada
        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Judul utama "' . $validated['judul'] . '" berhasil ditambahkan.');
    }


        // TAMPILKAN FORM EDIT JUDUL UTAMA
    public function edit(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('update', $informasi_publik_item);
        
        // Keamanan: Pastikan yang diedit bukan sub-menu
        if ($informasi_publik_item->parent_id !== null) {
            abort(404, 'Gunakan halaman sub-menu untuk mengedit item ini.');
        }

        $categories = InformasiPublikCategory::orderBy('nama')->get();

        return view('admin.informasi-publik.edit', compact('informasi_publik_item', 'categories'));
    }

    // PROSES UPDATE JUDUL UTAMA
    public function update(Request $request, InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('update', $informasi_publik_item);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404);
        }

        $validated = $request->validate([
            'judul'             => 'required|string|max:255|unique:informasi_publik,judul,' . $informasi_publik_item->id,
            'category_id'       => 'required|exists:informasi_publik_categories,id',
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
        ]);

        $data = [
            'judul'             => $validated['judul'],
            'category_id'       => $validated['category_id'],
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?: now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
        ];

        // Update slug jika judul berubah
        if ($informasi_publik_item->judul !== $validated['judul']) {
            $slug = Str::slug($validated['judul']);
            $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $informasi_publik_item->id)->count();
            if ($slugCount > 0) {
                $slug .= '-' . ($slugCount + 1);
            }
            $data['slug'] = $slug;
        }

        // Handle Upload File Baru
        if ($request->hasFile('file_dokumen')) {
            if ($informasi_publik_item->file_path && Storage::disk('public')->exists($informasi_publik_item->file_path)) {
                Storage::disk('public')->delete($informasi_publik_item->file_path);
            }
            $file = $request->file('file_dokumen');
            $data['file_path'] = $file->store('informasi_publik/dokumen', 'public');
            $data['file_nama'] = $file->getClientOriginalName();
            $data['file_tipe'] = $file->getClientOriginalExtension();
        }

        $informasi_publik_item->update($data);

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Judul utama "' . $validated['judul'] . '" berhasil diperbarui.');
    }

    // PROSES HAPUS JUDUL UTAMA (DENGAN PROTEKSI SUB-MENU)
    public function destroy(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('delete', $informasi_publik_item);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404);
        }

        // PROTEKSI: Cek apakah masih punya sub-menu
        if ($informasi_publik_item->children()->count() > 0) {
            $jmlSub = $informasi_publik_item->children()->count();
            return redirect()->route('admin.informasi-publik.index')
                ->with('error', 'Gagal menghapus! Judul utama "<strong>' . $informasi_publik_item->judul . '</strong>" masih memiliki ' . $jmlSub . ' sub-menu. Hapus semua sub-menunya terlebih dahulu.');
        }

        // Hapus file jika ada
        if ($informasi_publik_item->file_path && Storage::disk('public')->exists($informasi_publik_item->file_path)) {
            Storage::disk('public')->delete($informasi_publik_item->file_path);
        }

        $judul = $informasi_publik_item->judul;
        $informasi_publik_item->delete();

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Judul utama "' . $judul . '" berhasil dihapus.');
    }
        // Placeholder halaman Sub-Menu (Akan kita kerjakan selanjutnya)
     // Halaman Daftar Sub-Menu berdasarkan Parent
    
    
     public function subMenuIndex(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('viewAny', InformasiPublik::class);
        
        // Pastikan yang diakses adalah Judul Utama, bukan sub-menu lain
        if ($informasi_publik_item->parent_id !== null) {
            abort(404, 'Halaman tidak valid.');
        }

        // Ambil semua sub-menu milik parent ini, urutkan berdasarkan sort_order
        $subMenus = InformasiPublik::where('parent_id', $informasi_publik_item->id)
                                   ->orderBy('sort_order', 'asc')
                                   ->get();

        return view('admin.informasi-publik.sub-menu.index', compact('informasi_publik_item', 'subMenus'));
    }

        // TAMPILKAN FORM TAMBAH SUB-MENU
    public function subMenuCreate(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('create', InformasiPublik::class);
        
        // Keamanan: pastikan yang diakses benar-benar Judul Utama
        if ($informasi_publik_item->parent_id !== null) {
            abort(404, 'Halaman tidak valid.');
        }

        return view('admin.informasi-publik.sub-menu.create', compact('informasi_publik_item'));
    }

    // PROSES SIMPAN SUB-MENU
    public function subMenuStore(Request $request, InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('create', InformasiPublik::class);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404);
        }

        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'konten'            => 'nullable|string',
        ]);

        $filePath = null;
        $fileNama = null;
        $fileTipe = null;
        $thumbnailPath = null;

        // Proses Upload File Dokumen
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filePath = $file->store('informasi_publik/dokumen', 'public');
            $fileNama = $file->getClientOriginalName();
            $fileTipe = $file->getClientOriginalExtension();
        }

        // Proses Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumb = $request->file('thumbnail');
            $thumbnailPath = $thumb->store('informasi_publik/thumbnails', 'public');
        }

        // Buat slug unik
        $slug = Str::slug($validated['judul']);
        $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->count();
        if ($slugCount > 0) {
            $slug .= '-' . ($slugCount + 1);
        }

        // Simpan ke Database
        InformasiPublik::create([
            'category_id'       => $informasi_publik_item->category_id, // Otomatis ikut induk
            'parent_id'         => $informasi_publik_item->id,          // Otomatis ikut induk
            'judul'             => $validated['judul'],
            'slug'              => $slug,
            'konten'            => $validated['konten'] ?? '',
            'file_path'         => $filePath,
            'file_nama'         => $fileNama,
            'file_tipe'         => $fileTipe,
            'thumbnail'         => $thumbnailPath,
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?? now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
        ]);

        Cache::forget('informasi_publik_categories');

        // Redirect kembali ke halaman daftar sub-menu induknya
        return redirect()->route('admin.informasi-publik.sub-menu.index', $informasi_publik_item)
            ->with('success', 'Sub-menu "' . $validated['judul'] . '" berhasil ditambahkan.');
    }

        // TAMPILKAN FORM EDIT SUB-MENU
    public function subMenuEdit(InformasiPublik $informasi_publik_item, InformasiPublik $subMenu)
    {
        Gate::authorize('update', $subMenu);
        
        // KEAMANAN: Pastikan sub-menu yang diedit benar-benar anak dari induk ini
        // (Mencegah admin utak-atik URL untuk edit sub-menu milik induk lain)
        if ($subMenu->parent_id !== $informasi_publik_item->id) {
            abort(404, 'Sub-menu tidak ditemukan dalam induk ini.');
        }

        return view('admin.informasi-publik.sub-menu.edit', compact('informasi_publik_item', 'subMenu'));
    }

    // PROSES UPDATE SUB-MENU
    public function subMenuUpdate(Request $request, InformasiPublik $informasi_publik_item, InformasiPublik $subMenu)
    {
        Gate::authorize('update', $subMenu);
        
        if ($subMenu->parent_id !== $informasi_publik_item->id) {
            abort(404);
        }

        $validated = $request->validate([
            'judul'             => 'required|string|max:255|unique:informasi_publik,judul,' . $subMenu->id,
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'konten'            => 'nullable|string',
        ]);

        $data = [
            'judul'             => $validated['judul'],
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?? now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
            'konten'            => $validated['konten'] ?? '',
        ];

        // Update slug jika judul berubah
        if ($subMenu->judul !== $validated['judul']) {
            $slug = Str::slug($validated['judul']);
            $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $subMenu->id)->count();
            if ($slugCount > 0) {
                $slug .= '-' . ($slugCount + 1);
            }
            $data['slug'] = $slug;
        }

        // Hapus & Upload File Baru (jika admin ganti file)
        if ($request->hasFile('file_dokumen')) {
            if ($subMenu->file_path && Storage::disk('public')->exists($subMenu->file_path)) {
                Storage::disk('public')->delete($subMenu->file_path);
            }
            $file = $request->file('file_dokumen');
            $data['file_path'] = $file->store('informasi_publik/dokumen', 'public');
            $data['file_nama'] = $file->getClientOriginalName();
            $data['file_tipe'] = $file->getClientOriginalExtension();
        }

        // Hapus & Upload Thumbnail Baru (jika admin ganti thumbnail)
        if ($request->hasFile('thumbnail')) {
            if ($subMenu->thumbnail && Storage::disk('public')->exists($subMenu->thumbnail)) {
                Storage::disk('public')->delete($subMenu->thumbnail);
            }
            $thumb = $request->file('thumbnail');
            $data['thumbnail'] = $thumb->store('informasi_publik/thumbnails', 'public');
        }

        $subMenu->update($data);

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.sub-menu.index', $informasi_publik_item)
            ->with('success', 'Sub-menu "' . $validated['judul'] . '" berhasil diperbarui.');
    }

        // PROSES HAPUS SUB-MENU
    public function subMenuDestroy(InformasiPublik $informasi_publik_item, InformasiPublik $subMenu)
    {
        Gate::authorize('delete', $subMenu);
        
        // KEAMANAN: Pastikan sub-menu yang dihapus benar-benar anak dari induk ini
        if ($subMenu->parent_id !== $informasi_publik_item->id) {
            abort(404, 'Sub-menu tidak ditemukan dalam induk ini.');
        }

        // Hapus File Dokumen dari storage jika ada
        if ($subMenu->file_path && Storage::disk('public')->exists($subMenu->file_path)) {
            Storage::disk('public')->delete($subMenu->file_path);
        }

        // Hapus Thumbnail dari storage jika ada
        if ($subMenu->thumbnail && Storage::disk('public')->exists($subMenu->thumbnail)) {
            Storage::disk('public')->delete($subMenu->thumbnail);
        }

        // Simpan nama judul dulu untuk pesan sukses
        $judulSubMenu = $subMenu->judul;

        // Hapus datanya dari database
        $subMenu->delete();

        // Hapus cache
        Cache::forget('informasi_publik_categories');

        // Redirect kembali ke daftar sub-menu induknya
        return redirect()->route('admin.informasi-publik.sub-menu.index', $informasi_publik_item)
            ->with('success', 'Sub-menu "' . $judulSubMenu . '" berhasil dihapus.');
    }
}