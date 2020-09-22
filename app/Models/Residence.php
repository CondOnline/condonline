<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Residence extends Model
{
    use hasFactory;

    protected $fillable = [
        'number', 'block', 'lot', 'parking_spaces', 'extension'
    ];

    public function getAddressAttribute()
    {
        return $this->street->short . ' ' . $this->number;
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
