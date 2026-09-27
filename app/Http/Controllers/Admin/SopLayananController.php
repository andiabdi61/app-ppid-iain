<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SopLayananRequest;
use App\Models\SopLayanan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SopLayananController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', SopLayanan::class);

        $sopList = SopLayanan::orderByDesc('tanggal_efektif')->paginate(10);

        return view('admin.sop-layanan.index', compact('sopList'));
    }

    public function create()
    {
        Gate::authorize('create', SopLayanan::class);

        return view('admin.sop-layanan.create');
    }

    public function store(SopLayananRequest $request)
    {
        Gate::authorize('create', SopLayanan::class);

        $data = $request->safe()->except('file_sop');
        $file = $request->file('file_sop');
        $data['file_path'] = $file->store('sop-layanan', 'public');
        $data['file_nama'] = $file->getClientOriginalName();

        SopLayanan::create($data);

        return redirect()->route('admin.sop-layanan.index')->with('success', 'SOP Layanan berhasil ditambahkan!');
    }

    public function edit(SopLayanan $sop_layanan)
    {
        Gate::authorize('update', $sop_layanan);

        return view('admin.sop-layanan.edit', ['sop' => $sop_layanan]);
    }

    public function update(SopLayananRequest $request, SopLayanan $sop_layanan)
    {
        Gate::authorize('update', $sop_layanan);

        $data = $request->safe()->except('file_sop');

        if ($request->hasFile('file_sop')) {
            Storage::disk('public')->delete($sop_layanan->file_path);
            $file = $request->file('file_sop');
            $data['file_path'] = $file->store('sop-layanan', 'public');
            $data['file_nama'] = $file->getClientOriginalName();
        }

        $sop_layanan->update($data);

        return redirect()->route('admin.sop-layanan.index')->with('success', 'SOP Layanan berhasil diperbarui!');
    }

    public function destroy(SopLayanan $sop_layanan)
    {
        Gate::authorize('delete', $sop_layanan);

        Storage::disk('public')->delete($sop_layanan->file_path);
        $sop_layanan->delete();

        return redirect()->route('admin.sop-layanan.index')->with('success', 'SOP Layanan berhasil dihapus!');
    }
}
