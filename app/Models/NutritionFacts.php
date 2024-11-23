<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionFacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_id',
        'nutrient_name',
        'amount',
        'unit',
    ];

    // Define the relationship with the Recipe model
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
