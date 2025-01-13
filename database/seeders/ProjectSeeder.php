<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project1 = Project::create([
            'name'        => 'Web Development',
            'description' => 'backend & frontend',
            'exp_delivery_date' => '2024-11-25 20:12:54',
            'client_id' => 4,
            'freelancer_id'=>2,
            'section_id' => 4
        ]);
        $project2 = Project::create([
            'name'        => 'Graphic Design',
            'description' => 'logo design & marketing',
            'exp_delivery_date' => '2024-11-29 20:12:54',
            'client_id' => 4,
            'freelancer_id'=> 3,
            'section_id' => 2
        ]);
        $project3 = Project::create([
            'name'        => 'Writing',
            'description' => 'Content writing',
            'exp_delivery_date' => '2024-12-9 20:54:11',
            'client_id' => 5,
            'freelancer_id'=> 2,
            'section_id' => 3
        ]);
    }
}
