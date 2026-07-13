<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use App\Models\InformasiPublikCategory;
use App\Models\PermohonanInformasi;
use App\Models\PengajuanKeberatan;
use App\Models\DokumenCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class InformasiPublikController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Kategori (Diurutkan berdasarkan sort_order)
        $categories = Cache::remember('informasi_publik_categories', 60*60, function () {
            return InformasiPublikCategory::orderBy('sort_order')->get();
        });

        $search = $request->q;
        $kategoriSlug = $request->kategori;

        // 2. Cari ID Kategori jika slug dikirimkan
        $categoryId = null;
        if ($kategoriSlug && $kategoriSlug !== 'all') {
            $categoryId = InformasiPublikCategory::where('slug', $kategoriSlug)->value('id');
        }

        // 3. Jika ada pencarian, gunakan flat list (Scout/Eloquent biasa)
        if ($search) {
            if ($search) {
                $query = InformasiPublik::search($search)->where('is_active', true);
                if ($categoryId) {
                    $query->where('category_id', $categoryId);
                }
            } else {
                $query = InformasiPublik::query()
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->with('category');
                if ($categoryId) {
                    $query->where('category_id', $categoryId);
                }
            }
            
            $informasiPublik = $query->paginate(10)->withQueryString();
            
            // Kirim flag agar view tahu ini mode pencarian
            return view('informasi-publik.index', compact('informasiPublik', 'categories', 'search'));
        }

        // 4. Jika TIDAK ada pencarian, tampilkan dalam bentuk Grouped (Berpasangan)
        $groupedInformasi = InformasiPublikCategory::with(['informasiPublik' => function ($query) use ($categoryId) {
            $query->where('is_active', true)
                  ->whereNull('parent_id') // Hanya ambil Judul Utama
                  ->orderBy('sort_order')
                  ->with(['children' => function ($childQuery) {
                      $childQuery->where('is_active', true)
                                 ->orderBy('sort_order');
                  }]);
        }])
        ->when($categoryId, function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        })
        ->orderBy('sort_order')
        ->get();

        return view('informasi-publik.index', compact('groupedInformasi', 'categories'));
    }

    public function show($slug)
    {
        $informasi = InformasiPublik::where('slug', $slug)
                                    ->where('is_active', true)
                                    ->firstOrFail();

        $informasi->increment('hits');

        return view('informasi-publik.show', compact('informasi'));
    }

    public function showByCategory($categorySlug)
    {
        $category = InformasiPublikCategory::where('slug', $categorySlug)->firstOrFail();

        $informasiPublik = InformasiPublik::where('category_id', $category->id)
                                        ->where('is_active', true)
                                        ->orderBy('sort_order')
                                        ->paginate(10);

        return view('informasi-publik.index', compact('informasiPublik', 'category'));
    }

    public function laporanStatistik()
    {
        $totalPermohonan = PermohonanInformasi::count();
        $permohonanStatus = PermohonanInformasi::selectRaw('status, count(*) as count')
                                             ->groupBy('status')
                                             ->pluck('count', 'status');

        $totalKeberatan = PengajuanKeberatan::count();
        $keberatanStatus = PengajuanKeberatan::selectRaw('status, count(*) as count')
                                           ->groupBy('status')
                                           ->pluck('count', 'status');
        
        $totalInformasiPublik = InformasiPublik::count();
        $informasiPublikPerKategori = InformasiPublikCategory::withCount('informasiPublik')->get();

        $recentPermohonan = PermohonanInformasi::latest()->take(10)->get();
        $recentKeberatan = PengajuanKeberatan::latest()->take(10)->get();

        $currentYear = now()->year;
        $permohonanPerBulan = PermohonanInformasi::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');

        $keberatanPerBulan = PengajuanKeberatan::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');
        
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(null, $month, 1)->translatedFormat('F');
        });

        $permohonanLabels = $months->values();
        $permohonanData = $permohonanLabels->map(function ($label, $key) use ($permohonanPerBulan) {
            return $permohonanPerBulan[$key + 1] ?? 0;
        });

        $keberatanLabels = $months->values();
        $keberatanData = $keberatanLabels->map(function ($label, $key) use ($keberatanPerBulan) {
            return $keberatanPerBulan[$key + 1] ?? 0;
        });
        
        $laporanTahunanPPID = DokumenCategory::where('nama', 'Laporan Tahunan')
                                           ->first()
                                           ->dokumen ?? collect();
        
        return view('informasi-publik.laporan-statistik', compact(
            'totalPermohonan', 'permohonanStatus', 'totalKeberatan', 'keberatanStatus',
            'totalInformasiPublik', 'informasiPublikPerKategori',
            'recentPermohonan', 'recentKeberatan',
            'permohonanLabels', 'permohonanData', 'keberatanLabels', 'keberatanData',
            'laporanTahunanPPID'
        ));
    }
}