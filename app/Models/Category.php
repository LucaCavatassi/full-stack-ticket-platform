<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Define the inverse relationship with the Ticket model
    public function tickets()
    {
        return $this->hasOne(Ticket::class);
    }
}
