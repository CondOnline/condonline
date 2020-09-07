<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf', 'rg', 'gender', 'mobile_phone', 'birth',
        'photo', 'blocked', 'name', 'email', 'password',
        'first_login', 'dweller'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'date',
        'blocked' => 'boolean',
        'first_login' => 'boolean',
        'dweller' => 'boolean'
    ];

    protected $dates = [
        'birth'
    ];

    public function userAccessGroup()
    {
        return $this->belongsTo(UserAccessGroup::class);
    }

    public function residences()
    {
        return $this->belongsToMany(Residence::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
