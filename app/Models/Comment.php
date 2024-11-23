<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['comment', 'rating', 'user_id', 'recipes_id', 'comment_status' ];


    // Relationship with Recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
