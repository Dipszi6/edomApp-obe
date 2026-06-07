<?php

namespace App\Http\Controllers;

use App\Models\Dosen;

class DosenController extends Controller
{
    public function show($id)
    {
        $dosen = Dosen::with([
            'jurusan',
            'reviews' => fn($q) => $q->where('is_visible', true)
                ->orderBy('created_at', 'desc'),
            'reviews.user',
        ])->findOrFail($id);

        return view('dosen.show', compact('dosen'));
    }
}