<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $data['user'] = User::all();
        return view('user/index', $data);
    }

    function tambah()
    {
        return view('user/form');
    }

    function store(Request $request)
    {
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];
        User::create($data);
        return redirect()->to('user');
    }

    function edit($id)
    {
        $data['user'] = User::where('id', $id)->first();
        return view('user/form', $data);
    }

    function update(Request $request)
    {
        if ($request->password == NULL) {
            $data = [
                'name' => $request->nama,
                'email' => $request->email,
                'updated_at' => now(),
            ];
        } else {
            $data = [
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'updated_at' => now(),
            ];
        }

        User::where('id', $request->id)->update($data);
        return redirect()->to('user');
    }

    function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('user');
    }
}
