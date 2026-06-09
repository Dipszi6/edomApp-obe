<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewUpvote;
use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $request)
{
    // Jika diakses dari tombol ulas spesifik di halaman profil
    $selectedDosen = $request->dosen_id ? Dosen::find($request->dosen_id) : null;
    $selectedMatkul = $request->matkul_id ? Matkul::find($request->matkul_id) : null;

    // AMBIL SEMUA DATA (Untuk opsi pilihan dropdown secara real dari database)
    $dosens = Dosen::orderBy('nama', 'asc')->get();
    $matkuls = Matkul::orderBy('nama', 'asc')->get();

    return view('review.create', compact('selectedDosen', 'selectedMatkul', 'dosens', 'matkuls'));
}

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'ulasan' => 'required|min:10',
            'tags' => 'nullable|array',
            'dosen_id' => 'nullable|exists:dosens,id',
            'matkul_id' => 'nullable|exists:matkuls,id',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'dosen_id' => $request->dosen_id,
            'matkul_id' => $request->matkul_id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'tags' => $request->tags,
            'is_anonim' => $request->boolean('is_anonim'),
        ]);

        if ($review->dosen_id) {
            Dosen::find($review->dosen_id)->updateRating();
        }

        if ($review->matkul_id) {
            Matkul::find($review->matkul_id)->updateRating();
        }

        return redirect()->route('dashboard.mahasiswa')->with('success', 'Ulasan berhasil dikirim!');
    }

    public function upvote($id)
    {
        $review = Review::findOrFail($id);
        $userId = Auth::id();

        $exists = ReviewUpvote::where('user_id', $userId)
            ->where('review_id', $id)
            ->first();

        if ($exists) {
            $exists->delete();
            $review->decrement('upvotes');
        } else {
            ReviewUpvote::create(['user_id' => $userId, 'review_id' => $id]);
            $review->increment('upvotes');
        }

        return redirect()->back();
    }
}