<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tracking', 'sender', 'received', 'image', 'image_signature',
        'shipping_company', 'input_at', 'delivered_at'
    ];

    protected $dates = [
        'input_at', 'delivered_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }
}
