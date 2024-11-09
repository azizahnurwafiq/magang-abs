<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pelanggan;
use App\Models\Stok;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $data['invoices'] = Invoice::paginate(10);
        return view('invoice.index', $data);
    }

    public function create(Request $request)
    {
        $pelanggans = Pelanggan::all();
        $stoks = Stok::all();
        return view('invoice.create', compact('pelanggans', 'stoks'));
    }

    public function getNextInvoiceNumber($kode)
    {
        $latestInvoice = Invoice::where('kode', $kode)->orderBy('id', 'desc')->first();

        if ($latestInvoice) {
            $lastInvoiceNumber = explode('/', $latestInvoice->no_invoice)[2];
            $nextInvoiceNumber = (int)$lastInvoiceNumber + 1;
        } else {
            $nextInvoiceNumber = 1;
        }

        return str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);
    }

    public function generateInvoiceNumber(Request $request)
    {
        $request->validate([
            'kode' => 'required|in:tax,non_tax',
        ]);

        $kode = $request->input('kode');

        $nextSequence = $this->getNextInvoiceNumber($kode);

        $currentDate = date('mY');
        $month = substr($currentDate, 0, 2);
        $lastTwoDigitsYear = substr($currentDate, -2);
        $combinedDate = $month . $lastTwoDigitsYear;

        $invoicePrefix = $kode === 'non_tax' ? 'INST' : 'TAX';

        $nomorInvoice = "{$invoicePrefix}/{$combinedDate}/{$nextSequence}";

        return response()->json(['no_invoice' => $nomorInvoice]);
    }


    public function store(Request $request)
    {

        // $no_invoice = $this->generateInvoiceNumber($request);

        // $total = $request->total;
        $kekuranganBayar = $request->down_payment;
        // $kekuranganBayar = $total - $down_payment;

        if ($kekuranganBayar == 0) {
            $status = "LUNAS";
        } else {
            $status = "BELUM LUNAS";
        }

        $invoice = Invoice::create([
            'kode' => $request->kode,
            'no_invoice' => $request->no_invoice,
            'pelanggan_id' => $request->pelanggan_id,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'down_payment' => $request->down_payment,
            'total_invoice' => $request->total,
            'kekurangan_bayar' => $kekuranganBayar,
            'status' => $status,
        ]);

        // ambil data dari request
        $item = $request->item;
        $harga = $request->harga;
        $jumlah = $request->jumlah;

        if (count($item) === count($harga) && count($harga) === count($jumlah)) {
            $attachData = [];

            foreach ($item as $index => $stokId) {
                $attachData[$stokId] = [
                    'harga' => intval($harga[$index]),
                    'jumlah' => intval($jumlah[$index]),
                ];
            }
            $invoice->stoks()->attach($attachData);
        } else {
            return response()->json(['error' => 'Data item, harga, dan jumlah harus memiliki panjang yang sama.'], 400);
        }
        return redirect()->route('invoice.index')->with('success', 'Data invoice berhasil ditambahkan');
    }

    public function getHargaItem($id)
    {
        $stok = Stok::find($id);
        return response()->json(['harga_jual' =>  $stok->harga_jual]);
    }

    public function payment($id)
    {
        $payment = Invoice::find($id);
        return view('invoice.payment', compact('payment'));
    }
}
