<?php

namespace App\Models;

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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
