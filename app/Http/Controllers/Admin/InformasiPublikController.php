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
     * Daftar field terjemahan yang digunakan di semua method.
     */
    private const TRANSLATION_FIELDS = [
        'judul_en', 'judul_ar',
        'konten_en', 'konten_ar',
        'pejabat_en', 'pejabat_ar',
        'penanggung_jawab_en', 'penanggung_jawab_ar',
        'tempat_en', 'tempat_ar',
        'jangka_waktu_en', 'jangka_waktu_ar',
    ];

    /**
     * Aturan validasi terjemahan.
     */
    private function translationRules(): array
    {
        return [
            'judul_en'             => 'nullable|string|max:255',
            'judul_ar'             => 'nullable|string|max:255',
            'konten_en'            => 'nullable|string',
            'konten_ar'            => 'nullable|string',
            'pejabat_en'           => 'nullable|string|max:255',
            'pejabat_ar'           => 'nullable|string|max:255',
            'penanggung_jawab_en'  => 'nullable|string|max:255',
            'penanggung_jawab_ar'  => 'nullable|string|max:255',
            'tempat_en'            => 'nullable|string|max:255',
            'tempat_ar'            => 'nullable|string|max:255',
            'jangka_waktu_en'      => 'nullable|string|max:255',
            'jangka_waktu_ar'      => 'nullable|string|max:255',
        ];
    }

    /**
     * Ambil data terjemahan dari request (semua nullable).
     */
    private function translationData(array $validated): array
    {
        $data = [];
        foreach (self::TRANSLATION_FIELDS as $field) {
            $data[$field] = $validated[$field] ?? null;
        }
        return $data;
    }

    /**
     * INDEX
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', InformasiPublik::class);
        
        $categories = InformasiPublikCategory::orderBy('nama')->get();

        $query = InformasiPublik::with('category')
            ->leftJoin('informasi_publik_categories', 'informasi_publik.category_id', '=', 'informasi_publik_categories.id')
            ->whereNull('informasi_publik.parent_id')
            ->select('informasi_publik.*');

        if ($request->filled('filter_category')) {
            $query->where('informasi_publik.category_id', $request->filter_category);
        }

        $informasiPublik = $query->orderBy('informasi_publik_categories.nama', 'asc')
                                 ->orderBy('informasi_publik.sort_order', 'asc')
                                 ->paginate(20)
                                 ->appends(request()->query());

        return view('admin.informasi-publik.index', compact('informasiPublik', 'categories'));
    }

    /**
     * CREATE - Judul Utama
     */
    public function create()
    {
        Gate::authorize('create', InformasiPublik::class);
        $categories = InformasiPublikCategory::orderBy('sort_order')->orderBy('nama')->get();
        return view('admin.informasi-publik.create', compact('categories'));
    }

    /**
     * STORE - Judul Utama
     */
    public function store(Request $request)
    {
        Gate::authorize('create', InformasiPublik::class);

        $validated = $request->validate(array_merge([
            'judul'             => 'required|string|max:255|unique:informasi_publik,judul',
            'category_id'       => 'required|exists:informasi_publik_categories,id',
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
            'konten'            => 'nullable|string',
            'pejabat'           => 'nullable|string|max:255',
            'penanggung_jawab'  => 'nullable|string|max:255',
            'tempat'            => 'nullable|string|max:255',
            'jangka_waktu'      => 'nullable|string|max:255',
        ], $this->translationRules()));

        $filePath = null;
        $fileNama = null;
        $fileTipe = null;

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filePath = $file->store('informasi_publik/dokumen', 'public');
            $fileNama = $file->getClientOriginalName();
            $fileTipe = $file->getClientOriginalExtension();
        }

        $slug = Str::slug($validated['judul']);
        $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->count();
        if ($slugCount > 0) {
            $slug .= '-' . ($slugCount + 1);
        }

        InformasiPublik::create(array_merge([
            'judul'             => $validated['judul'],
            'slug'              => $slug,
            'category_id'       => $validated['category_id'],
            'parent_id'         => null,
            'konten'            => $validated['konten'] ?? '',
            'pejabat'           => $validated['pejabat'] ?? null,
            'penanggung_jawab'  => $validated['penanggung_jawab'] ?? null,
            'tempat'            => $validated['tempat'] ?? null,
            'jangka_waktu'      => $validated['jangka_waktu'] ?? null,
            'file_path'         => $filePath,
            'file_nama'         => $fileNama,
            'file_tipe'         => $fileTipe,
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?? now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
        ], $this->translationData($validated)));

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Judul utama "' . $validated['judul'] . '" berhasil ditambahkan.');
    }

    /**
     * EDIT - Judul Utama
     */
    public function edit(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('update', $informasi_publik_item);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404, 'Gunakan halaman sub-menu untuk mengedit item ini.');
        }

        $categories = InformasiPublikCategory::orderBy('nama')->get();
        return view('admin.informasi-publik.edit', compact('informasi_publik_item', 'categories'));
    }

    /**
     * UPDATE - Judul Utama
     */
    public function update(Request $request, InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('update', $informasi_publik_item);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404);
        }

        $validated = $request->validate(array_merge([
            'judul'             => 'required|string|max:255|unique:informasi_publik,judul,' . $informasi_publik_item->id,
            'category_id'       => 'required|exists:informasi_publik_categories,id',
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
            'konten'            => 'nullable|string',
            'pejabat'           => 'nullable|string|max:255',
            'penanggung_jawab'  => 'nullable|string|max:255',
            'tempat'            => 'nullable|string|max:255',
            'jangka_waktu'      => 'nullable|string|max:255',
        ], $this->translationRules()));

        $data = array_merge([
            'judul'             => $validated['judul'],
            'category_id'       => $validated['category_id'],
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?: now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
            'konten'            => $validated['konten'] ?? '',
            'pejabat'           => $validated['pejabat'] ?? null,
            'penanggung_jawab'  => $validated['penanggung_jawab'] ?? null,
            'tempat'            => $validated['tempat'] ?? null,
            'jangka_waktu'      => $validated['jangka_waktu'] ?? null,
        ], $this->translationData($validated));

        if ($informasi_publik_item->judul !== $validated['judul']) {
            $slug = Str::slug($validated['judul']);
            $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $informasi_publik_item->id)->count();
            if ($slugCount > 0) {
                $slug .= '-' . ($slugCount + 1);
            }
            $data['slug'] = $slug;
        }

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

    /**
     * DESTROY - Judul Utama
     */
    public function destroy(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('delete', $informasi_publik_item);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404);
        }

        if ($informasi_publik_item->children()->count() > 0) {
            $jmlSub = $informasi_publik_item->children()->count();
            return redirect()->route('admin.informasi-publik.index')
                ->with('error', 'Gagal menghapus! Judul utama "<strong>' . $informasi_publik_item->judul . '</strong>" masih memiliki ' . $jmlSub . ' sub-menu. Hapus semua sub-menunya terlebih dahulu.');
        }

        if ($informasi_publik_item->file_path && Storage::disk('public')->exists($informasi_publik_item->file_path)) {
            Storage::disk('public')->delete($informasi_publik_item->file_path);
        }

        $judul = $informasi_publik_item->judul;
        $informasi_publik_item->delete();

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Judul utama "' . $judul . '" berhasil dihapus.');
    }

    /**
     * SUB MENU - INDEX
     */
    public function subMenuIndex(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('viewAny', InformasiPublik::class);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404, 'Halaman tidak valid.');
        }

        $subMenus = InformasiPublik::where('parent_id', $informasi_publik_item->id)
                                   ->orderBy('sort_order', 'asc')
                                   ->get();

        return view('admin.informasi-publik.sub-menu.index', compact('informasi_publik_item', 'subMenus'));
    }

    /**
     * SUB MENU - CREATE
     */
    public function subMenuCreate(InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('create', InformasiPublik::class);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404, 'Halaman tidak valid.');
        }

        return view('admin.informasi-publik.sub-menu.create', compact('informasi_publik_item'));
    }

    /**
     * SUB MENU - STORE
     */
    public function subMenuStore(Request $request, InformasiPublik $informasi_publik_item)
    {
        Gate::authorize('create', InformasiPublik::class);
        
        if ($informasi_publik_item->parent_id !== null) {
            abort(404);
        }

        $validated = $request->validate(array_merge([
            'judul'             => 'required|string|max:255',
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'konten'            => 'nullable|string',
            'pejabat'           => 'nullable|string|max:255',
            'penanggung_jawab'  => 'nullable|string|max:255',
            'tempat'            => 'nullable|string|max:255',
            'jangka_waktu'      => 'nullable|string|max:255',
        ], $this->translationRules()));

        $filePath = null;
        $fileNama = null;
        $fileTipe = null;
        $thumbnailPath = null;

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filePath = $file->store('informasi_publik/dokumen', 'public');
            $fileNama = $file->getClientOriginalName();
            $fileTipe = $file->getClientOriginalExtension();
        }

        if ($request->hasFile('thumbnail')) {
            $thumb = $request->file('thumbnail');
            $thumbnailPath = $thumb->store('informasi_publik/thumbnails', 'public');
        }

        $slug = Str::slug($validated['judul']);
        $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->count();
        if ($slugCount > 0) {
            $slug .= '-' . ($slugCount + 1);
        }

        InformasiPublik::create(array_merge([
            'category_id'       => $informasi_publik_item->category_id,
            'parent_id'         => $informasi_publik_item->id,
            'judul'             => $validated['judul'],
            'slug'              => $slug,
            'konten'            => $validated['konten'] ?? '',
            'pejabat'           => $validated['pejabat'] ?? null,
            'penanggung_jawab'  => $validated['penanggung_jawab'] ?? null,
            'tempat'            => $validated['tempat'] ?? null,
            'jangka_waktu'      => $validated['jangka_waktu'] ?? null,
            'file_path'         => $filePath,
            'file_nama'         => $fileNama,
            'file_tipe'         => $fileTipe,
            'thumbnail'         => $thumbnailPath,
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?? now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
        ], $this->translationData($validated)));

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.sub-menu.index', $informasi_publik_item)
            ->with('success', 'Sub-menu "' . $validated['judul'] . '" berhasil ditambahkan.');
    }

    /**
     * SUB MENU - EDIT
     */
    public function subMenuEdit(InformasiPublik $informasi_publik_item, InformasiPublik $subMenu)
    {
        Gate::authorize('update', $subMenu);
        
        if ($subMenu->parent_id !== $informasi_publik_item->id) {
            abort(404, 'Sub-menu tidak ditemukan dalam induk ini.');
        }

        return view('admin.informasi-publik.sub-menu.edit', compact('informasi_publik_item', 'subMenu'));
    }

    /**
     * SUB MENU - UPDATE
     */
    public function subMenuUpdate(Request $request, InformasiPublik $informasi_publik_item, InformasiPublik $subMenu)
    {
        Gate::authorize('update', $subMenu);
        
        if ($subMenu->parent_id !== $informasi_publik_item->id) {
            abort(404);
        }

        $validated = $request->validate(array_merge([
            'judul'             => 'required|string|max:255|unique:informasi_publik,judul,' . $subMenu->id,
            'file_dokumen'      => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'jenis_tautan'      => 'nullable|in:file,url',
            'tautan_eksternal'  => 'nullable|url',
            'tanggal_publikasi' => 'nullable|date',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer|min:0',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'konten'            => 'nullable|string',
            'pejabat'           => 'nullable|string|max:255',
            'penanggung_jawab'  => 'nullable|string|max:255',
            'tempat'            => 'nullable|string|max:255',
            'jangka_waktu'      => 'nullable|string|max:255',
        ], $this->translationRules()));

        $data = array_merge([
            'judul'             => $validated['judul'],
            'tanggal_publikasi' => $validated['tanggal_publikasi'] ?? now(),
            'is_active'         => $request->boolean('is_active', true),
            'sort_order'        => $validated['sort_order'] ?? 0,
            'jenis_tautan'      => $validated['jenis_tautan'] ?? 'file',
            'tautan_eksternal'  => $validated['tautan_eksternal'] ?? null,
            'konten'            => $validated['konten'] ?? '',
            'pejabat'           => $validated['pejabat'] ?? null,
            'penanggung_jawab'  => $validated['penanggung_jawab'] ?? null,
            'tempat'            => $validated['tempat'] ?? null,
            'jangka_waktu'      => $validated['jangka_waktu'] ?? null,
        ], $this->translationData($validated));

        if ($subMenu->judul !== $validated['judul']) {
            $slug = Str::slug($validated['judul']);
            $slugCount = InformasiPublik::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $subMenu->id)->count();
            if ($slugCount > 0) {
                $slug .= '-' . ($slugCount + 1);
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('file_dokumen')) {
            if ($subMenu->file_path && Storage::disk('public')->exists($subMenu->file_path)) {
                Storage::disk('public')->delete($subMenu->file_path);
            }
            $file = $request->file('file_dokumen');
            $data['file_path'] = $file->store('informasi_publik/dokumen', 'public');
            $data['file_nama'] = $file->getClientOriginalName();
            $data['file_tipe'] = $file->getClientOriginalExtension();
        }

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

    /**
     * SUB MENU - DESTROY
     */
    public function subMenuDestroy(InformasiPublik $informasi_publik_item, InformasiPublik $subMenu)
    {
        Gate::authorize('delete', $subMenu);
        
        if ($subMenu->parent_id !== $informasi_publik_item->id) {
            abort(404, 'Sub-menu tidak ditemukan dalam induk ini.');
        }

        if ($subMenu->file_path && Storage::disk('public')->exists($subMenu->file_path)) {
            Storage::disk('public')->delete($subMenu->file_path);
        }

        if ($subMenu->thumbnail && Storage::disk('public')->exists($subMenu->thumbnail)) {
            Storage::disk('public')->delete($subMenu->thumbnail);
        }

        $judulSubMenu = $subMenu->judul;
        $subMenu->delete();

        Cache::forget('informasi_publik_categories');

        return redirect()->route('admin.informasi-publik.sub-menu.index', $informasi_publik_item)
            ->with('success', 'Sub-menu "' . $judulSubMenu . '" berhasil dihapus.');
    }
}