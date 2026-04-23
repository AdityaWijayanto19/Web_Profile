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
                'jabatan' => 'Public Relation',
                'keterangan' => 'Provoks 2025-2026. Managing external outreach, recruitment narratives, and strategic partnerships.',
                'urutan' => 0,
            ],
            [
                'jabatan' => 'Assistant Laboratorium IoT',
                'keterangan' => 'Laboratorium IoT 2025 - 2026. Managing end-to-end preparation and distribution of IoT hardware and measurement tools for academic practicums.',
                'urutan' => 1,
            ],
            [
                'jabatan' => 'Cohort Fullstack Developer',
                'keterangan' => 'DiCoding Camp DBS 2026. Selected for an intensive, job-readiness program mastering industry-standard web development curricula.',
                'urutan' => 2,
            ],
        ];

        foreach ($pengalamans as $pengalaman) {
            Pengalaman::create($pengalaman);
        }
    }
}
