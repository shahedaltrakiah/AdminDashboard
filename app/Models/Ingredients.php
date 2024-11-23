<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'ingredient_name',
        'quantity',
        'price',
    ];

    // Relationship with Recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
