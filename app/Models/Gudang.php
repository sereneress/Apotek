<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
>>>>>>> c410e5a8316167bdf026754654ee687a9ffd4d35

class Gudang extends Model
{
    use HasFactory;

<<<<<<< HEAD
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
=======
    protected $fillable = [
        'person_id', 'user_id', 'start_date',
        'employment_status', 'last_education', 'status',
        'profile_image', 'shift', 'warehouse_section'
    ];

    public function person()
    {
        return $this->belongsTo(People::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
>>>>>>> c410e5a8316167bdf026754654ee687a9ffd4d35
    }
}
