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
            'SKU' => 'required|string|max:20|regex:/^[A-Z0-9\-]+$/|unique:stoks,SKU',
            'item' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'harga_jual' => 'required|numeric|min:0',
            'harga_beli' => 'required|numeric|min:0',
        ], [
            'SKU.required' => 'SKU wajib diisi !!',
            'SKU.string' => 'SKU harus berupa teks !!',
            'SKU.max' => 'SKU tidak boleh lebih dari 20 karakter !!',
            'SKU.regex' => 'SKU hanya boleh mengandung huruf kapital, angka, dan tanda hubung (-) !!',
            'SKU.unique' => 'SKU sudah digunakan, silakan masukkan kode yang berbeda !!',
            'item.required' => 'Item wajib diisi !!',
            'item.string' => 'Item harus berupa teks !!',
            'item.max' => 'Item tidak boleh lebih dari 255 karakter !!',
            'jumlah.required' => 'Jumlah wajib diisi !!',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat !!',
            'jumlah.min' => 'Jumlah harus minimal 1 !!',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi !!',
            'tanggal_masuk.date' => 'Format tanggal tidak valid !!',
            'harga_jual.required' => 'Harga jual wajib diisi !!',
            'harga_jual.numeric' => 'Harga jual harus berupa angka !!',
            'harga_jual.min' => 'Harga jual tidak boleh negatif !!',
            'harga_beli.required' => 'Harga beli wajib diisi !!',
            'harga_beli.numeric' => 'Harga beli harus berupa angka !!',
            'harga_beli.min' => 'Harga beli tidak boleh negatif !!',
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


        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.stok_barang.barang')->with('success', 'Data item baru berhasil ditambahkan');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.stok_barang.barang')->with('success', 'Data item baru berhasil ditambahkan');
        }
    }

    public function addStokLama(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:20',
        ], [
            'jumlah.required' => 'Jumlah wajib diisi !!',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat !!',
            'jumlah.min' => 'Jumlah harus minimal 1 !!',
            'jumlah.max' => 'Jumlah tidak boleh lebih dari 20 karakter !!',
        ]);

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


        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.stok_barang.barang')->with('success', 'Data stok berhasil ditambahkan');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.stok_barang.barang')->with('success', 'Data stok berhasil ditambahkan');
        }
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

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.stok_barang.barang')->with('success', 'Data stok berhasil diupdate');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.stok_barang.barang')->with('success', 'Data stok berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $hapus = Stok::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data stok barang berhasil dihapus!']);
    }
}
