<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add the `slug` column without the unique constraint.
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title'); // Nullable for now
        });

        // Generate slugs for all existing tickets (if they are empty).
        DB::table('tickets')->get()->each(function ($ticket) {
            // Only update tickets that have an empty slug
            if (empty($ticket->slug)) {
                $slug = Str::slug($ticket->title); // Generate slug from title
                $uniqueSlug = $this->makeUniqueSlug($slug);
                DB::table('tickets')->where('id', $ticket->id)->update(['slug' => $uniqueSlug]);
            }
        });

        // Now that slugs are populated, add the unique constraint.
        Schema::table('tickets', function (Blueprint $table) {
            $table->unique('slug'); // Add unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('slug'); // Drop the slug column if rolling back
        });
    }

    /**
     * Ensure the slug is unique by appending a number if necessary.
     */
    protected function makeUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        // Check if the slug already exists in the database
        while (DB::table('tickets')->where('slug', $slug)->exists()) {
            // If the slug exists, append a number to make it unique
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
};
