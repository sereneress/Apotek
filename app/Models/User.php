<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'person_id',
        'username',
        'email',
        'password',
        'reference_id',
        'reference_type',
        'status',
    ];

    protected $hidden = ['password'];

    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    public function apoteker()
    {
        return $this->hasOne(Apoteker::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function reference()
    {
        return $this->morphTo();
    }
    
    public function hasRole($role)
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('name', $role)->exists();
        }

        return $this->roles()->where('name', $role)->exists();
    }
}
