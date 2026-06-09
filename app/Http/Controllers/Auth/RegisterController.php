<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('auth.register', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nim' => 'required|string|max:20|unique:users,nim',
            'angkatan' => 'nullable|digits:4|integer|min:2000|max:' . date('Y'),
            'jurusan_id' => 'nullable|exists:jurusans,id',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'angkatan.digits' => 'Angkatan harus 4 digit.',
            'jurusan_id.exists' => 'Jurusan tidak valid.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'jurusan_id' => $request->jurusan_id,
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Akun berhasil dibuat. Selamat datang, ' . $user->name . '!');
    }
}