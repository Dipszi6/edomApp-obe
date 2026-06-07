<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'user_id' => 4,
                'dosen_id' => 1,
                'matkul_id' => null,
                'rating' => 5,
                'ulasan' => 'Pak Budi sangat komunikatif, materi mudah dipahami.',
                'tags' => ['komunikatif', 'materi_jelas', 'nilai_adil'],
                'is_anonim' => true,
            ],
            [
                'user_id' => 5,
                'dosen_id' => 1,
                'matkul_id' => null,
                'rating' => 4,
                'ulasan' => 'Penjelasan bagus tapi kadang terlalu cepat.',
                'tags' => ['materi_jelas', 'tugas_wajar'],
                'is_anonim' => true,
            ],
            [
                'user_id' => 4,
                'dosen_id' => null,
                'matkul_id' => 2,
                'rating' => 3,
                'ulasan' => 'Basis data cukup menantang, tugas lumayan banyak.',
                'tags' => ['tugas_banyak', 'challenging'],
                'is_anonim' => false,
            ],
        ];

        foreach ($reviews as $item) {
            Review::create($item);
        }

        // Update avg_rating otomatis
        Dosen::find(1)->updateRating();
        Matkul::find(2)->updateRating();
    }
}