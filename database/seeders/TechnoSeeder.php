<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;

class TechnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technos = [
            'Laravel',
            'React',
            'Vue.js',
            'Django',
            'Ruby on Rails',
        ];
        foreach ($technos as $item) {
            $new_techno = new Technology();
            $new_techno->technologies = $item;
            $new_techno->slug = helper::makeSlug($new_techno->technologies, new Technology());
            $new_techno->save();
        }
    }
}
