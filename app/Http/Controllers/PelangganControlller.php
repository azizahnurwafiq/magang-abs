<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganControlller extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::paginate(2);
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_WA' => 'required',
            'alamat' => 'required',
            'note' => 'required',
        ], [
            'nama.required' => 'nama wajib diisi !!',
            'email.required' => 'email wajib diisi !!',
            'no_WA.required' => 'nomor WA wajib diisi !!',
            'alamat.required' => 'alamat wajib diisi !!',
            'note.required' => 'note wajib diisi !!',
        ]);

        Pelanggan::create($validatedData);

        return redirect()->route('pelanggan')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_WA' => 'required',
            'alamat' => 'required',
            'note' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_WA' => $request->no_WA,
            'alamat' => $request->alamat,
            'note' => $request->note,
        ];

        Pelanggan::where('id', $request->id)->update($data);

        return redirect()->route('pelanggan')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $hapus = Pelanggan::find($id);
        $hapus->delete();
        return redirect()->route('pelanggan')->with('success', 'Data berhasil dihapus');
    }
}