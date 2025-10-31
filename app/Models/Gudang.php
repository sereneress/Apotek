<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudangs';

    protected $fillable = [
        'person_id',
        'user_id',
        'start_date',
        'employment_status',
        'last_education',
        'status',
        'profile_image',
        'shift',
        'warehouse_section',
    ];

    // 🔹 Relasi ke People
    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    // 🔹 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔹 Morph untuk reference user (jika polymorphic)
    public function reference()
    {
        return $this->morphTo();
    }
}
