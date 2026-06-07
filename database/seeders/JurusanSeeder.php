<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'TI', 'nama' => 'Teknik Informatika', 'fakultas' => 'Fakultas Teknik'],
            ['kode' => 'SI', 'nama' => 'Sistem Informasi', 'fakultas' => 'Fakultas Teknik'],
            ['kode' => 'TK', 'nama' => 'Teknik Komputer', 'fakultas' => 'Fakultas Teknik'],
            ['kode' => 'MTK', 'nama' => 'Matematika', 'fakultas' => 'Fakultas MIPA'],
        ];

        foreach ($data as $item) {
            Jurusan::create($item);
        }
    }
}