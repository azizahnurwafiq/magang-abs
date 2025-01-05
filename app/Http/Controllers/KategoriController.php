<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data['kategoris'] = Kategori::sortable()->paginate(5);
        return view('kategori.index', $data);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/'
        ], [
            'kategori.required' => 'Kategori wajib diisi!',
            'kategori.string' => 'Kategori harus berupa teks !!',
            'kategori.max' => 'Nama kategori tidak boleh lebih dari 100 karakter !!',
            'kategori.regex' => 'Nama kategori hanya boleh mengandung huruf dan spasi !!',
        ]);

        Kategori::create($validatedData);

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.kategori.index')->with('success', 'Data kategori berhasil ditambahkan');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        $data = [
            'kategori' => $request->kategori,
        ];

        Kategori::where('id', $request->id)->update($data);

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.kategori.index')->with('success', 'Data kategori berhasil diupdate');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $hapus = Kategori::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data kategori berhasil dihapus!']);
    }
}
