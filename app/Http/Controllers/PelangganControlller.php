<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganControlller extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:pelanggans,email|max:150',
            'no_WA' => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s,.-]+$/',
            'note' => 'required|string|max:500',
        ], [
            'nama.required' => 'Nama wajib diisi !!',
            'nama.string' => 'Nama harus berupa teks !!',
            'nama.max' => 'Nama tidak boleh lebih dari 100 karakter !!',
            'nama.regex' => 'Nama hanya boleh mengandung huruf dan spasi !!',
            'email.required' => 'email wajib diisi !!',
            'email.email' => 'Format email tidak valid !!',
            'email.unique' => 'Email sudah dipakai !!',
            'email.max' => 'Email tidak boleh lebih dari 150 karakter !!',
            'no_WA.required' => 'nomor WA wajib diisi !!',
            'no_WA.digits_between' => 'Nomor WA harus antara 10-15 digit !!',
            'no_WA.regex' => 'Nomor WA hanya boleh berisi angka !!',
            'alamat.required' => 'alamat wajib diisi !!',
            'alamat.string' => 'Alamat harus berupa teks !!',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter !!',
            'alamat.regex' => 'Alamat hanya boleh mengandung huruf, angka, spasi, koma, titik, atau tanda hubung !!',
            'note.required' => 'note wajib diisi !!',
            'note.string' => 'Catatan harus berupa teks !!',
            'note.max' => 'Catatan tidak boleh lebih dari 500 karakter !!',
        ]);

        Pelanggan::create($validatedData);

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan');
        }
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

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate');
        }

    }

    public function destroy($id)
    {
        $hapus = Pelanggan::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data pelanggan berhasil dihapus!']);
    }
}
