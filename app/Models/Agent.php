<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the inverse relationship with the Ticket model
    public function tickets()
    {
        return $this->hasOne(Ticket::class);
    }
}
