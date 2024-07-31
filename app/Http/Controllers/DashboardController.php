<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    function index()
    {
        $data['transaksi'] = Transaksi::all()->count();
        $data['produk'] = Produk::all()->count();
        $data['admin'] = User::all()->count();
        return view('dashboard', $data);
    }
}
