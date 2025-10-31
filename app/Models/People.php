<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class People extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $fillable = [
        'name',
        'sex',
        'pob',
        'dob',
        'personable_type',
        'personable_id'
    ];

    public function personable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'person_id');
    }
}
