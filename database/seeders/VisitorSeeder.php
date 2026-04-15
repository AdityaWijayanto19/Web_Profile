<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ips = [
            '192.168.1.1',
            '192.168.1.2',
            '192.168.1.3',
            '192.168.1.4',
            '192.168.1.5',
        ];

        $paths = [
            '/',
            '/admin/dashboard',
            '/admin/projects',
            '/admin/sertifikats',
            '/admin/technologies',
        ];

        // Create 50 visitor records for last 30 days
        for ($i = 0; $i < 50; $i++) {
            Visitor::create([
                'ip_address' => $ips[array_rand($ips)],
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'referer' => 'https://www.google.com',
                'page_path' => $paths[array_rand($paths)],
                'visited_at' => now()->subDays(random_int(0, 29))->subHours(random_int(0, 23))->subMinutes(random_int(0, 59)),
            ]);
        }
    }
}
