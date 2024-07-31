<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = 'id';
    protected $fillable = ['produk_id', 'nama_customer', 'alamat', 'jumlah', 'total_pembayaran', 'status_pembayaran'];


    function Produk()
    {
        return $this->belongsTo(Produk::class)->withDefault();
    }
}
