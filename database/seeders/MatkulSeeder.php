<?php

namespace Database\Seeders;

use App\Models\Matkul;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'TI301', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 5, 'jurusan_id' => 1],
            ['kode' => 'TI302', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 4, 'jurusan_id' => 1],
            ['kode' => 'TI401', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 6, 'jurusan_id' => 1],
            ['kode' => 'SI301', 'nama' => 'Analisis Sistem', 'sks' => 3, 'semester' => 5, 'jurusan_id' => 2],
            ['kode' => 'MTK201', 'nama' => 'Kalkulus Lanjut', 'sks' => 4, 'semester' => 3, 'jurusan_id' => 4],
            ['kode' => 'TI309', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 5, 'jurusan_id' => 1, 'avg_rating' => 4.7, 'total_review' => 98],
            ['kode' => 'TI303', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 4, 'jurusan_id' => 1, 'avg_rating' => 4.5, 'total_review' => 112],
            ['kode' => 'TI403', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 6, 'jurusan_id' => 1, 'avg_rating' => 4.8, 'total_review' => 75],
            ['kode' => 'SI303', 'nama' => 'Analisis Sistem', 'sks' => 3, 'semester' => 5, 'jurusan_id' => 2, 'avg_rating' => 4.4, 'total_review' => 64],
            ['kode' => 'MTK203', 'nama' => 'Kalkulus Lanjut', 'sks' => 4, 'semester' => 3, 'jurusan_id' => 4, 'avg_rating' => 4.2, 'total_review' => 89],
        ];

        foreach ($data as $item) {
            Matkul::create($item);
        }
    }
}