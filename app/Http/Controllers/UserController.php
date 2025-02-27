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

        return redirect()->route('manager.manage_user.user')->with('success', 'Data user berhasil ditambahkan');
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
        return redirect()->route('manager.manage_user.user')->with('success', 'Berhasil mengupdate data user');
    }

    public function destroy($id)
    {
        $authUser = auth()->user();

        $hapus = User::find($id);

        if (!$hapus) {
            return response()->json(['message' => 'User tidak ditemukan!'], 404);
        }

        if($authUser->id == $hapus->id){
            return response()->json(['message' => 'Anda tidak bisa menghapus akun Anda sendiri!'], 400);
        }

        $hapus->delete();

        return response()->json(['status' => 'Data user berhasil dihapus!'], 200);
    }
}
