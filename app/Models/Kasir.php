<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasirs';

    protected $fillable = [
        'person_id',
        'user_id',
        'start_date',
        'employment_status',
        'last_education',
        'status',
        'profile_image',
        'shift',
    ];

    // 🔹 Relasi ke People (polymorphic melalui person_id)
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
