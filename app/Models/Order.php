<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['order_status', 'order_date', 'delivery_address', 'total_amount',];


    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
