<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualanItem extends Model
{
    protected $fillable = [
        'transaksi_penjualan_id',
        'obat_id',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'transaksi_penjualan_id');
    }
}
