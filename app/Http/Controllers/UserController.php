<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manage_user.index', compact('users'));
    }

    public function create()
    {
        return view('manage_user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [
            'username.required' => 'Username wajib diisi !!',
            'password.required' => 'Password wajib diisi !!',
            'role.required' => 'Role wajib diisi !!',
        ]);

        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        User::create($data);

        return redirect()->route('admin.manage_user.user')->with('success', 'Data user berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('manage_user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $cari = User::find($id);

        if ($request->password == "") {
            $cari->update([
                'username' => $request->username,
                'role' => $request->role,
            ]);
        } else {
            $cari->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        }
        return redirect()->route('admin.manage_user.user')->with('success', 'Data user berhasil diupdate');
    }

    public function destroy($id)
    {
        $hapus = User::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data user berhasil dihapus!']);
    }
}
