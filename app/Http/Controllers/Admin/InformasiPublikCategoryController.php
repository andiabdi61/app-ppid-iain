<?php

namespace App\Http\Controllers\Admin;

use App\Models\InformasiPublikCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache; // ← DITAMBAHKAN

class InformasiPublikCategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', InformasiPublikCategory::class);
        $categories = InformasiPublikCategory::withCount('informasiPublik')->orderBy('nama')->paginate(10);
        return view('admin.informasi-publik-categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('create', InformasiPublikCategory::class);
        return view('admin.informasi-publik-categories.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', InformasiPublikCategory::class);

        $request->validate([
            'nama' => 'required|string|max:100|unique:informasi_publik_categories,nama',
            'nama_en' => 'nullable|string|max:100',
            'nama_ar' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'deskripsi_ar' => 'nullable|string',
        ]);

        $category = InformasiPublikCategory::create([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'nama_ar' => $request->nama_ar,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'deskripsi_en' => $request->deskripsi_en,
            'deskripsi_ar' => $request->deskripsi_ar,
        ]);

        Cache::forget('informasi_publik_categories'); // ← DITAMBAHKAN

        return redirect()->route('admin.informasi-publik-categories.index')->with('success', 'Kategori "' . $category->nama . '" berhasil ditambahkan!');
    }

    public function edit(InformasiPublikCategory $informasi_publik_category)
    {
        Gate::authorize('update', $informasi_publik_category);
        return view('admin.informasi-publik-categories.edit', compact('informasi_publik_category'));
    }

    public function update(Request $request, InformasiPublikCategory $informasi_publik_category)
    {
        Gate::authorize('update', $informasi_publik_category);

        $request->validate([
            'nama' => 'required|string|max:100|unique:informasi_publik_categories,nama,' . $informasi_publik_category->id,
            'nama_en' => 'nullable|string|max:100',
            'nama_ar' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'deskripsi_ar' => 'nullable|string',
        ]);

        $informasi_publik_category->update([
            'nama' => $request->nama,
            'nama_en' => $request->nama_en,
            'nama_ar' => $request->nama_ar,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'deskripsi_en' => $request->deskripsi_en,
            'deskripsi_ar' => $request->deskripsi_ar,
        ]);

        Cache::forget('informasi_publik_categories'); // ← DITAMBAHKAN

        return redirect()->route('admin.informasi-publik-categories.index')->with('success', 'Kategori "' . $informasi_publik_category->nama . '" berhasil diperbarui!');
    }

    public function destroy(InformasiPublikCategory $informasi_publik_category)
    {
        Gate::authorize('delete', $informasi_publik_category);

        if ($informasi_publik_category->informasiPublik()->count() > 0) {
            return redirect()->route('admin.informasi-publik-categories.index')->with('error', 'Gagal menghapus! Masih ada ' . $informasi_publik_category->informasiPublik()->count() . ' item dalam kategori ini.');
        }

        $categoryName = $informasi_publik_category->nama;
        $informasi_publik_category->delete();

        Cache::forget('informasi_publik_categories'); // ← DITAMBAHKAN

        return redirect()->route('admin.informasi-publik-categories.index')->with('success', 'Kategori "' . $categoryName . '" berhasil dihapus!');
    }
}