<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions\Helper;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 20; $i++) {

            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->title = $faker->words(1, true);
            $new_project->slug = helper::makeSlug($new_project->title, new Project());
            $new_project->github = 'https://github.com/PatrizioCorcione/laravel-auth';
            $new_project->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum magni, neque quisquam perspiciatis in accusantium quo iure voluptas tempore sequi facilis quis quam provident libero soluta consequatur, deserunt quia pariatur a numquam? Cumque, suscipit. Earum consequatur corporis nisi modi quam ea suscipit numquam aut alias dolorum, tenetur, quisquam omnis, tempore debitis! Id accusantium, sunt quod possimus perferendis distinctio nisi esse at nobis dignissimos modi animi dolorem quia sit veniam, suscipit magni itaque commodi facere placeat asperiores quas! Asperiores labore a atque totam repellat et exercitationem facilis natus beatae iusto quo cupiditate soluta aut amet rerum maxime optio, dicta nulla modi nostrum temporibus reprehenderit. Mollitia saepe aut, eaque recusandae quaerat iste harum explicabo officiis deleniti corporis a voluptatem illum id nihil numquam, nulla ex quisquam autem assumenda quo modi corrupti dolorem. Omnis odit error labore voluptate, laudantium explicabo saepe sed sapiente, eveniet eos excepturi pariatur veniam asperiores nostrum totam doloribus provident magnam amet impedit velit voluptatibus dolor ea! At blanditiis eveniet repellat sint eius! Repellendus temporibus dicta labore illum atque inventore sunt odit soluta ea accusantium quibusdam asperiores debitis mollitia dolores eveniet, distinctio, provident officia unde dolorem architecto rem voluptates sed nesciunt! Quidem sequi, maiores nobis tempore minus commodi doloremque sint magni, reiciendis at quibusdam tenetur in sit pariatur cupiditate eveniet nam error.';
            $new_project->save();
        }
    }
}
