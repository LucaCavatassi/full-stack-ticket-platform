<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 10 agents
        foreach (range(1, 10) as $index) {
            Category::create([
                'title' => $faker->sentence(3),  // Generate a fake name
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
