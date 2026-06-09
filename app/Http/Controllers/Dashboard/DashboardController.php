<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class DashboardController extends Controller
{
    public function mahasiswa()
    {
        // 1. Ambil data user yang sedang login saat ini
        $user = Auth::user();

        // 2. Ambil semua ulasan yang pernah ditulis oleh mahasiswa ini
        // Kita gunakan eager loading (with) agar data dosen/matkul ikut terbawa tanpa query berulang
        $myReviews = Review::with(['dosen', 'matkul'])
                            ->where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        // 3. Hitung total ulasan yang sudah ditulis
        $myReviewsCount = $myReviews->count();

        // 4. Hitung total upvote yang didapatkan dari semua ulasannya
        $totalUpvotesReceived = $myReviews->sum('upvotes');

        // 5. Lempar semua variabel ke dalam view dashboard mahasiswa
        return view('dashboard.mahasiswa', compact('myReviews', 'myReviewsCount', 'totalUpvotesReceived'));
    }
}