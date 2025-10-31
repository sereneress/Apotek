<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiObat extends Model
{
    protected $table = 'transaksi_obat';
    protected $fillable = [
        'kode_transaksi', 'obat_id', 'kategori_id', 'supplier_id', 
        'jumlah', 'harga_satuan', 'total_harga', 'tanggal_transaksi'
    ];

    public function obat() {
        return $this->belongsTo(Obat::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

}
