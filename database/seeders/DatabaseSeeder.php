<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'roles' => 'admin',
            'email_verified_at' => Carbon::now(),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $this->call(JurusanSeeder::class);
    }
}
