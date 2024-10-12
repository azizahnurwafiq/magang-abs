<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class Stok_barangController extends Controller
{
    protected $paginationTheme = 'bootstrap';

    public function index()
    {
        $datas = Stok::paginate(3);
        return view('stok_barang.index', compact('datas'));
    }

    public function createbarang()
    {
        $datas = Stok::all();
        return view('stok_barang.createbarang', compact('datas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'SKU' => 'required',
            'kategori' => 'required',
            'item' => 'required',
            'warna' => 'required',
            'jumlah' => 'required',
            'tanggal_masuk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
        ], [
            'sku.required' => 'sku wajib diisi',
            'kategori.required' => 'kategori wajib diisi',
            'item.required' => 'item wajib diisi',
            'warna.required' => 'warna wajib diisi',
            'jumlah.required' => 'jumlah wajib diisi',
            'tanggal_masuk.required' => 'tanggal masuk wajib diisi',
            'harga_beli.required' => 'harga beli wajib diisi',
            'harga_jual.required' => 'harga jual wajib diisi',
        ]);

        $data = [
            'SKU' => $request->SKU,
            'kategori' => $request->kategori,
            'item' => $request->item,
            'warna' => $request->warna,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ];

        Stok::create($data);

        return redirect()->route('stok_barang.barang')->with('success', 'Stok berhasil ditambahkan');
    }
}
