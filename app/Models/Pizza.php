<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'toppings' => 'array',
    ];

    protected $fillable = [
        'name',
        'description',
        'toppings',
        // Add other fillable fields as needed
    ];

    // Relationships or other model code can go here

    // Your existing model code
}
