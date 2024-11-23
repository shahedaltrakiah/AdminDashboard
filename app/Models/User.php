<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'full_name',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship with Recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // Relationship with Comments and Reviews
    public function commentsReviews()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship with Followers (Who is following)
    public function followers()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    // Relationship with Following (Who they are following)
    public function following()
    {
        return $this->hasMany(Follower::class, 'followed_id');
    }

    // Relationship with Wishlist
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Relationship with Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship with Messages (Sender)
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Relationship with Messages (Receiver)
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
