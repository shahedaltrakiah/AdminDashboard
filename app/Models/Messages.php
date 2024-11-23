<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'status',
        'updated_at',
    ];

    // Relationship with Sender (User)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship with Receiver (Admin)
    public function receiver()
    {
        return $this->belongsTo(Admin::class, 'receiver_id');
    }
}
