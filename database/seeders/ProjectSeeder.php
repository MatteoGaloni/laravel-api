<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $types = Type::all();
        $technologies = Technology::all(['id']);
        $projectsName = [
            'TechArray',
            'CodeMarvel',
            'DataGenius',
            'CyberTech',
            'MatrixValley',
            'SmartConnect',
            'RandomSilver',
            'BrainValue',
            'DigitalNumber',
            'BipolarEP',
        ];

        for ($i = 0; $i < 10; $i++) {
            $newProject = new Project();
            $newProject->title = $projectsName[$i];
            $newProject->description = $faker->text(50);
            $newProject->img = $faker->imageUrl(800, 600,  $newProject->title);
            $newProject->type_id = rand(1, count($types));
            $newProject->save();

            $myNumber = rand(0, 6);
            $arrayTechnologies = [];
            for ($c = 0; $c <  $myNumber; $c++) {
                $arrayTechnologies[] = $technologies->random()->id;
            }
            $newProject->technologies()->attach(array_unique($arrayTechnologies));
        }
    }
}
