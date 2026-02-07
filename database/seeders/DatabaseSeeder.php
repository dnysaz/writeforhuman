<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil AdminSeeder yang baru saja Anda buat
        $this->call([
            AdminSeeder::class,
        ]);

        // Opsional: Buat 10 user tambahan untuk meramaikan dashboard admin saat testing
        User::factory(10)->create();
    }
}