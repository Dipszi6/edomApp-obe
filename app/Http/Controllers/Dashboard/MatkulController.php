<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    // --- FITUR ADMIN: CRUD ---

    public function index()
    {
        $matkuls = Matkul::with(['jurusan', 'dosen'])->paginate(10);
        return view('dashboard.admin.matkul.index', compact('matkuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required|unique:matkuls',
            'nama_matkul' => 'required',
            'sks' => 'required|integer',
        ]);

        Matkul::create($request->all());
        return redirect()->route('matkul.index')->with('success', 'Matkul berhasil ditambah.');
    }

    public function edit(Matkul $matkul)
    {
        return view('dashboard.admin.matkul.edit', compact('matkul'));
    }


    public function update(Request $request, Matkul $matkul)
    {
        $matkul->update($request->all());
        return redirect()->route('matkul.index')->with('success', 'Matkul diupdate.');
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();
        return redirect()->route('matkul.index')->with('success', 'Matkul dihapus.');
    }

    // --- FITUR MAHASISWA: DETAIL & REVIEW ---

    public function show(string $id)
    {
        // Kode yang sudah Anda miliki, digabung di sini
        $matkul = Matkul::with([
            'jurusan',
            'reviews' => fn($q) => $q->where('is_visible', true)->orderBy('created_at', 'desc'),
            'reviews.user',
        ])->findOrFail($id);

        return view('matkul.show', compact('matkul'));
    }
}