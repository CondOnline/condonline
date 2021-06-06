<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use hasFactory;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf', 'rg', 'gender', 'mobile_phone', 'birth',
        'photo', 'blocked', 'name', 'email', 'password',
        'first_login', 'dweller', 'dark_mode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
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

    protected $encrypted = [
        'cpf'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

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

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function circulars()
    {
        return $this->belongsToMany(Circular::class);
    }

}
