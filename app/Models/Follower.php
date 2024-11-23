<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    // Relationship with Follower (User who follows)
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    // Relationship with Followed (User being followed)
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
