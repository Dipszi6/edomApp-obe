<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    // --- FITUR ADMIN: CRUD ---

    public function index(Request $request)
    {
        $search = $request->search;

        $matkuls = Matkul::with('jurusan')
            ->when($search, function ($query) use ($search) {
                $query->where('kode', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString();

        $jurusans = Jurusan::all();

        return view(
            'dashboard.admin.matkul.index',
            compact('matkuls', 'jurusans')
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matkuls,kode',
            'nama' => 'required',
            'sks' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Matkul::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'jurusan_id' => $request->jurusan_id,
            'avg_rating' => 0,
            'total_review' => 0,
        ]);

        return redirect()
            ->route('matkul.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }


    public function create()
    {
        $jurusans = Jurusan::all();

        return view('dashboard.admin.matkul.create', compact('jurusans'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi harus menggunakan nama field yang benar (sesuai Model)
        $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1',
        ], [
            'kode.required' => 'Kode mata kuliah wajib diisi.',
            'nama.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required' => 'Jumlah SKS wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
        ]);

        // 2. Cari data berdasarkan ID
        $matkul = Matkul::findOrFail($id);

        // 3. Update data menggunakan request yang divalidasi
        $matkul->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('matkul.index')->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    public function edit($id)
    {
        $matkul = Matkul::findOrFail($id);
        $jurusans = Jurusan::all(); // Sesuaikan jika perlu

        return view('dashboard.admin.matkul.edit', compact('matkul', 'jurusans'));
    }

    public function destroy($id)
    {
        // 1. Cari data berdasarkan ID
        $matkul = \App\Models\Matkul::findOrFail($id);

        // 2. Hapus data
        $matkul->delete();

        // 3. Kembali ke halaman index dengan pesan sukses
        return redirect()->route('matkul.index')->with('success', 'Mata Kuliah berhasil dihapus!');
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