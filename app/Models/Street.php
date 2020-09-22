<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Street extends Model
{
    use hasFactory;

    protected $fillable = [
        'long', 'short'
    ];

    public function residences()
    {
        return $this->hasMany(Residence::class);
    }
}
