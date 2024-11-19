<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = ['date', 'status_id', 'title', 'description', 'agent_id', 'category_id', 'slug'];

    // Define relationship with the Status model
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Define relationship with the Agent model
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    // Define relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Automatically generate the slug when creating or updating a ticket.
     */
    protected static function boot()
    {
        //     boot() Method:
        // •	This method hooks into the creating and updating events of the Ticket model.
        // •	Before a ticket is created, the creating event is triggered, and the slug is generated using the generateUniqueSlug method.
        // •	If the ticket is updated and its title has changed, the updating event will regenerate the slug.
        parent::boot();

        static::creating(function ($ticket) {
            // Generate the slug before the ticket is created
            $ticket->slug = $ticket->generateUniqueSlug($ticket->title);
        });

        static::updating(function ($ticket) {
            // If the title is updated, regenerate the slug
            if ($ticket->isDirty('title')) {
                $ticket->slug = $ticket->generateUniqueSlug($ticket->title);
            }
        });
    }

    /**
     * Generate a unique slug based on the title.
     */
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        return $this->makeUniqueSlug($slug);
    }

    /**
     * Ensure the slug is unique by appending a number if necessary.
     */
    protected function makeUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        // Check if the slug already exists in the database
        while (self::where('slug', $slug)->exists()) {
            // If the slug exists, append a number to make it unique
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}