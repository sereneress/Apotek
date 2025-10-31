<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

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
    }
}
