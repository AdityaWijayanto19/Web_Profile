<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PengalamanSeeder::class,
        ]);

        // Create admin user
        User::factory()->create([
            'name' => 'Yunnappie',
            'email' => 'adityaputraw49@gmail.com',
            'password' => bcrypt('password123'),
        ]);
    }

}
