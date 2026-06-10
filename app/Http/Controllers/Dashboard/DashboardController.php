<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $jurusans = \App\Models\Jurusan::orderBy('nama')->get();

        // 5. Lempar semua variabel ke dalam view dashboard mahasiswa
        return view('dashboard.mahasiswa', compact('myReviews', 'myReviewsCount', 'totalUpvotesReceived','jurusans'));
    }

    public function settings()
    {
        $jurusans = \App\Models\Jurusan::orderBy('nama')->get();
        return view('dashboard.mahasiswaSettings', compact('jurusans'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jurusan_id' => 'required|exists:jurusans,id',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success_password', 'Password berhasil diperbarui.');
    }
}

