<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class DosenDashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;

        if (!$dosen) {
            abort(403, 'Profil dosen tidak ditemukan.');
        }

        $reviews = $dosen->reviews()
            ->with(['matkul', 'user'])
            ->where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $notifCount = $dosen->reviews()
            ->where('is_visible', true)
            ->where('created_at', '>', Auth::user()->updated_at)
            ->count();

        Auth::user()->touch();

        return view('dashboard.dosen', compact('dosen', 'reviews', 'notifCount'));
    }

    public function profileSettings()
    {
        $dosen = Auth::user()->dosen;
        $jurusans = \App\Models\Jurusan::orderBy('nama')->get();

        return view('dashboard.dosenSettings', compact('dosen', 'jurusans'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'gelar' => 'nullable|string|max:50',
            'jurusan_id' => 'required|exists:jurusans,id',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jurusan_id' => $request->jurusan_id,
        ]);

        $dosen->update([
            'nama' => $request->name,
            'gelar' => $request->gelar,
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