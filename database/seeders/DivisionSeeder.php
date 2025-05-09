<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['name' => 'IT Support'],
            ['name' => 'HRD'],
            ['name' => 'Finance'],
            ['name' => 'Marketing'],
            ['name' => 'Sales'],
            ['name' => 'Production'],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
