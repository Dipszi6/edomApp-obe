<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'user_id' => 2,
                'nidn' => '0012345601',
                'nama' => 'Budi Santoso',
                'gelar' => 'S.Kom., M.T.',
                'jurusan_id' => 1,
            ],
            [
                'user_id' => 3,
                'nidn' => '0023456702',
                'nama' => 'Siti Rahayu',
                'gelar' => 'S.T., M.Kom.',
                'jurusan_id' => 1,
            ],
            [
                'user_id' => null,
                'nidn' => '0034567803',
                'nama' => 'Ahmad Fauzi',
                'gelar' => 'Dr., S.Si., M.Sc.',
                'jurusan_id' => 4,
            ],
        ];

        foreach ($data as $item) {
            Dosen::create($item);
        }
    }
}