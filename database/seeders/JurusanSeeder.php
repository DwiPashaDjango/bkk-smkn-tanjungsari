<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'name' => 'ASPER'
        ]);

        Jurusan::create([
            'name' => 'TKJ'
        ]);

        Jurusan::create([
            'name' => 'TKRO'
        ]);

        Jurusan::create([
            'name' => 'MM'
        ]);
    }
}
