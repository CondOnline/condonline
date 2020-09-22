<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use hasFactory;

    protected $fillable = [
        'title', 'permission'
    ];

    public function userAccessGroups()
    {
        return $this->belongsToMany(UserAccessGroup::class);
    }
}
