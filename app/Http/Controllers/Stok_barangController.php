<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Stok;
use App\Models\StokHistory;
use Illuminate\Http\Request;

class Stok_barangController extends Controller
{
    protected $paginationTheme = 'bootstrap';

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword != null) {
            $datas = Stok::with(['kategori', 'stokHistories'])
                ->where('SKU', 'LIKE', '%' . $keyword . '%')
                ->orWhere('item', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('kategori', function ($query) use ($keyword) {
                    $query->where('kategori', 'LIKE', '%' . $keyword . '%');
                })
                ->sortable()->paginate(3);
        } else {
            $datas = Stok::sortable()->paginate(4);
        }
        return view('stok_barang.index', compact('datas'));
    }

    public function addItem()
    {
        $kategoris = Kategori::all();
        return view('stok_barang.add_item', compact('kategoris'));
    }

    public function addStok()
    {
        $stoks = Stok::all();
        return view('stok_barang.add_stok', compact('stoks'));
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
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ];

        Stok::create($data);

        $stok = Stok::where('SKU', $request->SKU)->first();

        $dataHistory = [
            'stok_id' => $stok->id,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total_stok' => $request->jumlah,
        ];

        StokHistory::create($dataHistory);

        return redirect()->route('stok_barang.barang')->with('success', 'Data item baru berhasil ditambahkan');
    }

    public function addStokLama(Request $request)
    {
        $skuStok = intval($request->SKU);

        $stokHistory = StokHistory::where('stok_id', $skuStok)->latest('total_stok')->first();

        $totalStokLama = $stokHistory ? $stokHistory->total_stok : 0;
        $jumlahBaru = intval($request->jumlah);

        $total_stok_baru = $totalStokLama + $jumlahBaru;

        StokHistory::create([
            'stok_id' => $skuStok,
            'jumlah' => $jumlahBaru,
            'tanggal_masuk' => $request->tanggal_masuk_baru,
            'total_stok' => $total_stok_baru,
        ]);

        return redirect()->route('stok_barang.barang')->with('success', 'Data stok berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategoris = Kategori::all();
        $stok = Stok::find($id);
        return view('stok_barang.edit', compact('stok', 'kategoris'));
    }

    public function show($id)
    {
        $stok = Stok::with('stokHistories')->find($id);
        return view('stok_barang.details', compact('stok'));
    }

    public function update(Request $request, $id)
    {
        $kategori = intval($request->kategori);

        $stok = Stok::find($id);

        $data = [
            'SKU' => $request->SKU,
            'kategori_id' => $kategori,
            'item' => $request->item,
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
