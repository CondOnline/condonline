<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccessGroup extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
