<?php

namespace Database\Seeders;

use App\Models\Pengalaman;
use Illuminate\Database\Seeder;

class PengalamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengalamans = [
            [
                'jabatan' => 'Frontend Intern',
                'keterangan' => 'Tech Studio Inc - 2021. Focus on mastering modern UI architecture.',
                'urutan' => 0,
            ],
            [
                'jabatan' => 'Junior Developer',
                'keterangan' => 'Cyber Nexus - 2022. Developing scalable React applications.',
                'urutan' => 1,
            ],
            [
                'jabatan' => 'UI Engineer',
                'keterangan' => 'Freelance - 2023 - Now. Crafting immersive 3D experiences with Three.js.',
                'urutan' => 2,
            ],
        ];

        foreach ($pengalamans as $pengalaman) {
            Pengalaman::create($pengalaman);
        }
    }
}
