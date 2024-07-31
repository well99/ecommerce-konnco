<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

use App\Models\Transaksi;

class TransaksiController extends Controller
{

    function index()
    {
        $data['transaksi'] = Transaksi::with('Produk')->get();
        return view('transaksi', $data);
    }

    function add(Request $request)
    {
        $data = [
            'produk_id' => $request->id_produk,
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'jumlah' => $request->jumlah,
            'total_pembayaran' => $request->total,
            'status_pembayaran' => 'belum_dibayar'
        ];
        $transaksi = Transaksi::create($data);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('Server_Key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi->id,
                'gross_amount' => $transaksi->total_pembayaran,
            ),
            'customer_details' => array(
                'nama_customer' => $request->nama,
                'alamat' => $request->alamat,
                'jumlah_beli' => $request->jumlah
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['pesan' => 'create', 'id_transaksi' => $transaksi->id, 'tokensnap' => $snapToken]);
    }

    function callback($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $produk = Produk::where('id', $transaksi->produk_id)->first();
        Produk::where('id', $transaksi->produk_id)->update(['stok' => ($produk->stok - $transaksi->jumlah)]);
        Transaksi::where('id', $id)->update(['status_pembayaran' => 'dibayar']);
        return response()->json(['pesan' => 'Berhasil']);
    }
}
