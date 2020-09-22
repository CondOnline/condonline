<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'text'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function archives()
    {
        return $this->hasMany(CircularArchive::class);
    }

}
