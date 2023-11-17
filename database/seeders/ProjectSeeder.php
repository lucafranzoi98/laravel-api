<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 30; $i++) {
            $project = new Project();
            $project->title = $faker->text(50);
            $project->slug = Str::slug($project->title, '-');
            $project->image = $faker->imageUrl(category: 'web');
            $project->description = $faker->text();
            $project->code_link = $faker->url();
            $project->preview_link = $faker->url();
            $project->save();
        }
    }
}
