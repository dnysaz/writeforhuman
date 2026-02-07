<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@writeforhuman.com', 
            'password' => Hash::make('Lemarikaca01'), 
            'role' => 'admin',
            'email_verified_at' => Carbon::now(), 
        ]);
    }
}