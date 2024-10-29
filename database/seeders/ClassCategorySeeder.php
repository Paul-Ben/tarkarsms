<?php

namespace Database\Seeders;

use App\Models\ClassCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassCategory::factory()->create([
            'name' => 'Kindergerten',
            'abbreviation' => 'KG',

        ]);
        ClassCategory::factory()->create([
            'name' => 'Primary',
            'abbreviation' => 'PRM',

        ]);
        ClassCategory::factory()->create([
            'name' => 'Junior Secondary',
            'abbreviation' => 'JS',

        ]);
        ClassCategory::factory()->create([
            'name' => 'Senior Secondary',
            'abbreviation' => 'SS',

        ]);
    }
}
