<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->q;
        $jurusanId = $request->jurusan_id;

        $dosens = Dosen::with('jurusan')
            ->when($query, fn($q) => $q->where('nama', 'like', "%{$query}%"))
            ->when($jurusanId, fn($q) => $q->where('jurusan_id', $jurusanId))
            ->get();

        $matkuls = Matkul::with('jurusan')
            ->when($query, fn($q) => $q->where('nama', 'like', "%{$query}%"))
            ->when($jurusanId, fn($q) => $q->where('jurusan_id', $jurusanId))
            ->get();

        return view('search', compact('dosens', 'matkuls', 'query'));
    }
}