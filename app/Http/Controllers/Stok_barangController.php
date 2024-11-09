<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Stok;
use Illuminate\Http\Request;

class Stok_barangController extends Controller
{
    protected $paginationTheme = 'bootstrap';

    public function index()
    {
        $datas = Stok::paginate(6);
        return view('stok_barang.index', compact('datas'));
    }

    public function addItem()
    {
        $kategoris = Kategori::all();
        return view('stok_barang.add_item', compact('kategoris'));
    }

    public function addStok()
    {
        $kategoris = Kategori::all();
        $datas = Stok::all();
        return view('stok_barang.add_stok', compact('datas', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'SKU' => 'required|unique:stoks,SKU',
            'item' => 'required',
            'jumlah' => 'required',
            'tanggal_masuk' => 'required',
            'harga_jual' => 'required',
        ], [
            'SKU.required' => 'sku wajib diisi !!',
            'SKU.unique' => 'kode sudah digunakan, silahkan masukkan kode yang berbeda',
            'item.required' => 'item wajib diisi !!',
            'jumlah.required' => 'jumlah wajib diisi !!',
            'tanggal_masuk.required' => 'tanggal masuk wajib diisi !!',
            'harga_jual.required' => 'harga jual wajib diisi !!',
        ]);

        $data = [
            'SKU' => $request->SKU,
            'kategori_id' => $request->kategori,
            'item' => $request->item,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ];

        Stok::create($data);

        return redirect()->route('stok_barang.barang')->with('success', 'Data item baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $stok = Stok::find($id);
        return view('stok_barang.edit', compact('stok'));
    }

    public function show($id)
    {
        $stok = Stok::find($id);
        return view('stok_barang.details', compact('stok'));
    }

    public function update(Request $request, $id)
    {
        $stok = Stok::find($id);

        $data = [
            'kategori' => $request->kategori,
            'item' => $request->item,
            'warna' => $request->warna,
            'jumlah' => $request->jumlah,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ];

        $stok->update($data);

        return redirect()->route('stok_barang.barang')->with('success', 'Data stok berhasil diupdate');
    }

    public function destroy($id)
    {
        $hapus = Stok::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data stok barang berhasil dihapus!']);
    }
}
