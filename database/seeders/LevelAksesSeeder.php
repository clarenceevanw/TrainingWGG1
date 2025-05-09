<?php

namespace Database\Seeders;

use App\Models\LevelAkses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelAkses = [
            ['name' => 'Admin'],
            ['name' => 'Bos'],
            ['name' => 'Karyawan']
        ];

        foreach ($levelAkses as $level) {
            LevelAkses::create($level);
        }
    }
}
