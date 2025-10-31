<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apoteker extends Model
{
    use HasFactory;

    protected $table = 'apotekers';
    protected $fillable = [
        'person_id',
        'user_id',
        'license_number',
        'employment_status',
        'last_education',
        'shift',
        'start_date',
        'status',
        'profile_image'
    ];

    // morphOne ke People
    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }


    // morphOne ke User
    public function reference()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
