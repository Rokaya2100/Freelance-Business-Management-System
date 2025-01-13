<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section1 = Section::create([
            'name'        => 'Web Development',
            'description' => 'backend & frontend',
        ]);
        $section2 = Section::create([
            'name'        => 'Graphic Design',
            'description' => 'logo design & marketing',
        ]);
        $section3 = Section::create([
            'name'        => 'Writing',
            'description' => 'Content writing',
        ]);
        $section4 = Section::create([
            'name'        => 'Digital Marketing',
            'description' => 'SEo & social media marketing',
        ]);
    }
}
