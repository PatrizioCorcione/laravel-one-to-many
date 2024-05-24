<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions\Helper;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {

            $new_project = new Project();
            $new_project->title = $faker->words(1, true);
            $new_project->slug = helper::makeSlug($new_project->title, new Project());
            $new_project->description = $faker->words(1, true);
            $new_project->save();
        }
    }
}
