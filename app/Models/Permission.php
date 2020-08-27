<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'title', 'permission'
    ];

    public function userAccessGroups()
    {
        return $this->belongsToMany(UserAccessGroup::class);
    }
}
