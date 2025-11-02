<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatObat extends Model
{
    protected $table = 'riwayat_obat';
    protected $fillable = [
        'obat_id',
        'tipe',
        'jumlah',
        'harga_satuan',
        'total',
        'sumber',
        'user_id',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
