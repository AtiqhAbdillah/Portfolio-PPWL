<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $faker->seed(20261020);

        for ($number = 0; $number < 25; $number++) {
            $title = ucfirst($faker->unique()->words(3, true));

            Project::firstOrCreate(
                ['title' => $title],
                [
                    'description' => $faker->paragraph(),
                    'status' => 'published',
                ],
            );
        }
    }
}
