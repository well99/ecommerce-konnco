<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;

class CustomerController extends Controller
{
    function index()
    {
        return view('halaman_customer');
    }

    function api_index()
    {
        $data = Produk::where('status_produk', 'aktif')->get();
        return response()->json(['data' => $data]);
    }

    function api_produk_by_id($id)
    {
        $data = Produk::where(['id' => $id, 'status_produk' => 'aktif'])->first();
        return response()->json(['produk' => $data]);
    }
}
