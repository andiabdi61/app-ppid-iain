<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\DokumenCategory;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $category = null;

        if ($request->filled('kategori') && $request->kategori != 'all') {
            $category = DokumenCategory::where('slug', $request->kategori)->first();

            $dokumen = Dokumen::where('is_active', true)
                ->whereHas('category', fn($q) => $q->where('slug', $request->kategori))
                ->orderBy('tanggal_publikasi', 'desc')
                ->with('category')
                ->paginate(10);
        } else {
            $dokumen = Dokumen::where('is_active', true)
                ->whereHas('category', fn($q) => $q->directDisplay())
                ->orderBy('tanggal_publikasi', 'desc')
                ->with('category')
                ->paginate(10);
        }

        return view('publikasi.index', compact('dokumen', 'category'));
    }

    public function show($slug)
    {
        $dokumen = Dokumen::where('slug', $slug)
                            ->where('is_active', true)
                            ->firstOrFail();

        $dokumen->increment('hits');

        return view('publikasi.show', compact('dokumen'));
    }
}