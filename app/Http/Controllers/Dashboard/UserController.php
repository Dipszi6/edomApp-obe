<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('dashboard.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'role' => ['required', 'in:admin,dosen,mahasiswa'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Jika role-nya dosen, buat entry di tabel dosens
            if ($request->role === 'dosen') {
                Dosen::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'nidn' => $request->nidn,
                    'jurusan_id' => $request->jurusan_id,
                ]);
            }

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(string $id)
    {
        // Memuat user beserta relasi dosen (jika rolenya dosen)
        $user = User::with(['dosen'])->findOrFail($id);
        $users = User::latest()->paginate(10);

        return view('dashboard.admin.users.edit', compact('user', 'users'));
    }

    public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    // 1. Data dasar User
    $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
    ];

    // 2. Jika Mahasiswa, isi kolomnya. Jika bukan, kosongkan agar bersih
    $userData['nim'] = ($request->role === 'mahasiswa') ? $request->nim : $user->nim;
    $userData['angkatan'] = ($request->role === 'mahasiswa') ? $request->angkatan : $user->angkatan;
    $userData['jurusan_id'] = ($request->role === 'mahasiswa' || $request->role === 'dosen') ? $request->jurusan_id : null;

    $user->update($userData);

    // 3. Penanganan relasi Dosen
    if ($request->role === 'dosen') {
        $dosen = Dosen::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nidn' => $request->nidn, 
                'gelar' => $request->gelar, 
                'nama' => $request->name, 
                'jurusan_id' => $request->jurusan_id
            ]
        );
        
        if ($request->hasFile('foto')) {
            if ($dosen->foto) Storage::disk('public')->delete($dosen->foto);
            $dosen->update(['foto' => $request->file('foto')->store('assets/dosen', 'public')]);
        }
    } else {
        // Jika berubah role bukan jadi dosen, hapus data dosen jika ada
        if ($user->dosen) {
            if ($user->dosen->foto) Storage::disk('public')->delete($user->dosen->foto);
            $user->dosen->delete();
        }
    }

    return redirect()->route('users.index')->with('success', 'Data berhasil diperbarui!');
}

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        if ($user->dosen && $user->dosen->foto) {
            Storage::disk('public')->delete($user->dosen->foto);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}