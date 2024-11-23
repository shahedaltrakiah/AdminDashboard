<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';

    protected $fillable = ['user_id', 'category_name', 'title', 'description', 'time', 'image','is_active'];

    // Relationship with Ingredients
    public function ingredients()
    {
        return $this->hasMany(Ingredients::class);
    }

    // Relationship with Instructions
    public function instructions()
    {
        return $this->hasMany(Instructions::class);
    }

    // Relationship with Nutrition Facts
    public function nutritionFacts()
    {
        return $this->hasMany(NutritionFacts::class);
    }

    // Relationship with Comments & Reviews
    public function commentsReviews()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship with Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
