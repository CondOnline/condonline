<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    protected $fillable = [
        'number', 'block', 'lot', 'parking_spaces', 'extension'
    ];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
