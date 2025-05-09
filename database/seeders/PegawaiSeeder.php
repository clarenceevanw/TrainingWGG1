<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Pegawai;
use App\Models\LevelAkses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::create([
            'name' => 'Evan',
            'email' => 'clarenceevan0907@gmail.com',
            'division_id' => Division::where('name', 'IT Support')->first()->id,
            'level_akses_id' => LevelAkses::where('name', 'Admin')->first()->id,
        ]);
        Pegawai::create([
            'name' => 'Adit Prasetyo',
            'email' => 'c14240069@john.petra.ac.id',
            'division_id' => Division::where('name', 'Finance')->first()->id,
            'level_akses_id' => LevelAkses::where('name', 'Karyawan')->first()->id,
        ]);
        Pegawai::create([
            'name' => 'Clarence Evan Wijaya',
            'email' => 'clarenceevanw@gmail.com',
            'division_id' => Division::where('name', 'IT Support')->first()->id,
            'level_akses_id' => LevelAkses::where('name', 'Bos')->first()->id,
        ]);
    }
}
