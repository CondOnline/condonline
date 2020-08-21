<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $fillable = [
        'long', 'short'
    ];

    public function residences()
    {
        return $this->hasMany(Residence::class);
    }
}
