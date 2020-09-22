<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use hasFactory;

    protected $fillable = ['title'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
