<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiObat extends Model
{
    use HasFactory;

    protected $table = 'transaksi_obat';

    protected $fillable = [
        'kode_transaksi',
        'obat_id',
        'kategori_id',
        'supplier',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal_transaksi',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
