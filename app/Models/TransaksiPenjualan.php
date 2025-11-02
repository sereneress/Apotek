<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $fillable = [
        'kode_transaksi', 'tanggal', 'total', 'user_id'
    ];

    public function items() {
        return $this->hasMany(TransaksiPenjualanItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
