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
            'kategori' => 'required'
        ], [
            'kategori.required' => 'Kategori wajib diisi!',
        ]);

        Kategori::create($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil ditambahkan');
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

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $hapus = Kategori::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data kategori berhasil dihapus!']);
    }
}
