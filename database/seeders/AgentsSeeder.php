<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AgentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 10 agents
        foreach (range(1, 10) as $index) {
            Agent::create([
                'name' => $faker->name,  // Generate a fake name
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}