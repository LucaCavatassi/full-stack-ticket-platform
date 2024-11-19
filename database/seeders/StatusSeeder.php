<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 3 specific agents using Eloquent
        Status::create([
            'title' => 'Assegnato',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Status::create([
            'title' => 'In lavorazione',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Status::create([
            'title' => 'Chiuso',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
