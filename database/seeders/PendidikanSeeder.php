<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikans = [
            [
                'gelar' => 'Bachelor of Software Engineering',
                'instansi' => 'University of Technology',
                'periode' => '2016 - 2020',
                'keterangan' => 'Graduated with Honors. Focused on Distributed Systems and Graphics Programming. Research focused on scalable microservices and real-time data processing.',
                'urutan' => 1,
            ],
            [
                'gelar' => 'Master of Computer Science',
                'instansi' => 'Stanford University',
                'periode' => '2020 - 2022',
                'keterangan' => 'Advanced specialization in Machine Learning and Data Science. Thesis on Deep Learning optimization techniques and neural network acceleration.',
                'urutan' => 2,
            ],
            [
                'gelar' => 'Professional Certification - Cloud Architect',
                'instansi' => 'Amazon Web Services (AWS)',
                'periode' => '2023 - Present',
                'keterangan' => 'AWS Certified Solutions Architect - Professional. Expertise in designing scalable and resilient cloud infrastructure on AWS platform.',
                'urutan' => 3,
            ],
        ];

        foreach ($pendidikans as $pendidikan) {
            Pendidikan::create($pendidikan);
        }
    }
}
