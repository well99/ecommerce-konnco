<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = 'id';
    protected $fillable = ['nama_produk', 'harga', 'stok', 'status_produk', 'foto'];
}

function Transaksi()
{
    return $this->hasOne(Transaksi::class)->withDefault();
}
