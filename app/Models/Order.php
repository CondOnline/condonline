<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use hasFactory;

    protected $fillable = [
        'tracking', 'sender', 'received', 'image', 'image_signature',
        'shipping_company', 'input_at', 'delivered_at'
    ];

    protected $dates = [
        'input_at', 'delivered_at'
    ];

    public function getStatusAttribute()
    {
        if ($this->delivered_at) {
            return 'Entregue';
        }else {
            return 'Pendente';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }
}
