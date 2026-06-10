@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    
    <!-- Navigasi Kembali -->
    <div class="mb-4">
        <a href="{{ route('users.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900 font-medium">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar User
        </a>
    </div>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah User Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Daftarkan akun baru ke dalam sistem database.</p>
    </div>

    <!-- Form Box -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="space-y-4 mb-6">
                <!-- Input Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                        class="w-full rounded-lg border-gray-300 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror" placeholder="Nama Lengkap User" required>
                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Input Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                        class="w-full rounded-lg border-gray-300 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror" placeholder="nama@univ.ac.id" required>
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Pilihan Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hak Akses (Role)</label>
                    <select name="role" class="w-full rounded-lg border-gray-300 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('role') border-red-500 @enderror" required>
                        <option value="" disabled selected>-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    </select>
                    @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" 
                        class="w-full rounded-lg border-gray-300 p-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('password') border-red-500 @enderror" placeholder="Minimal 8 karakter" required>
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Aksi Tombol -->
            <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('users.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium shadow-sm transition duration-150">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection