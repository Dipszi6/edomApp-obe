<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserSeeder extends Seeder
{
    use HasFactory, Notifiable;
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin RateMyClass',
            'email' => 'admin@rmc.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Dosen
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@dosen.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'jurusan_id' => 1,
        ]);

        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@dosen.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'jurusan_id' => 1,
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@mhs.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '2021001',
            'angkatan' => 2021,
            'jurusan_id' => 1,
        ]);

        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@mhs.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '2021002',
            'angkatan' => 2021,
            'jurusan_id' => 1,
        ]);
    }
}