<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 10 tickets
        foreach (range(1, 20) as $index) {
            Ticket::create([
                'date' => $faker->dateTimeThisYear(),  // Generate a random date this year
                'status_id' => $faker->numberBetween(1, 3),  // Random number between 1 and 3 for status_id
                'title' => $faker->sentence(),  // Generate a random title
                'description' => $faker->paragraph(),  // Generate a random description
                'agent_id' => $faker->numberBetween(1, 10),  // Random number between 1 and 10 for agent_id
                'category_id' => $faker->numberBetween(1, 10),  // Random number between 1 and 10 for category_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}