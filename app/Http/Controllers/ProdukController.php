<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    function index()
    {
        $data['produk'] = Produk::all();
        return view('produk/index', $data);
    }

    function tambah()
    {
        return view('produk/form');
    }

    function store(Request $request)
    {
        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images/foto_produk'), $imageName);
        Produk::create([
            'nama_produk' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $imageName,
            'status_produk' => $request->status
        ]);
        return redirect()->to('produk');
    }

    function edit($id)
    {
        $data['produk'] = Produk::where('id', $id)->first();
        return view('produk/form', $data);
    }

    function update(Request $request)
    {
        if ($request->foto == null) {
            $data = [
                'nama_produk' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'status_produk' => $request->status
            ];
        } else {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/foto_produk'), $imageName);
            $data = [
                'nama_produk' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'foto' => $imageName,
                'status_produk' => $request->status
            ];
        }

        Produk::where('id', $request->id)->update($data);
        return redirect()->to('produk');
    }

    function aktif($id)
    {
        $data = Produk::where('id', $id)->first();
        Produk::where('id', $data->id)->update(['status_produk' => 'aktif']);
        return redirect()->to('produk');
    }

    function nonaktif($id)
    {
        $data = Produk::where('id', $id)->first();
        Produk::where('id', $data->id)->update(['status_produk' => 'nonaktif']);
        return redirect()->to('produk');
    }

    function destroy($id)
    {
        Produk::where('id', $id)->delete();
        return redirect()->to('produk');
    }
}
