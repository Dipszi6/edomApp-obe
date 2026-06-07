<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_user' => User::count(),
            'total_dosen' => Dosen::count(),
            'total_matkul' => Matkul::count(),
            'total_review' => Review::count(),
        ];

        $reviews = Review::with('user', 'dosen', 'matkul')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.admin', compact('stats', 'reviews'));
    }

    public function toggleReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_visible' => !$review->is_visible]);

        return redirect()->back()->with('success', 'Status ulasan diperbarui.');
    }
}