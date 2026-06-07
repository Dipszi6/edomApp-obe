<?php

namespace App\Http\Controllers;

use App\Models\Matkul;

class MatkulController extends Controller
{
    public function show($id)
    {
        $matkul = Matkul::with([
            'jurusan',
            'reviews' => fn($q) => $q->where('is_visible', true)
                ->orderBy('created_at', 'desc'),
            'reviews.user',
        ])->findOrFail($id);

        return view('matkul.show', compact('matkul'));
    }
}