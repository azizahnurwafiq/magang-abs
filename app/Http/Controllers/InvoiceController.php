<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_tax;
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
        // $request->validate([
        //     'kode' => 'required',
        //     'no_invoice' => 'required',
        //     'pelanggan_id' => 'required',
        //     'alamat' => 'required',
        //     'tanggal' => 'required',
        //     'judul' => 'required',
        //     'stok_id' => 'required',
        //     'harga' => 'required',
        //     'jumlah' => 'required',
        //     'pembayaran_awal' => 'required',
        //     'status' => 'required',
        // ], [
        //     'kode.required' => 'Kode wajib diisi!',
        //     'no_invoice.required' => 'Nomor invoice wajib diisi!',
        //     'pelanggan_id.required' => 'Pelanggan wajib diisi!',
        //     'alamat.required' => 'Alamat wajib diisi!',
        //     'tanggal.required' => 'Tanggal wajib diisi!',
        //     'judul.required' => 'Judul wajib diisi!',
        //     'stok_id.required' => 'Item wajib diisi!',
        //     'harga.required' => 'Harga wajib diisi!',
        //     'jumlah.required' => 'Jumlah wajib diisi!',
        //     'pembayaran_awal.required' => 'Pembayaran wajib diisi!',
        //     'status.required' => 'Status wajib diisi!',
        // ]);

        $no_invoice = $this->generateInvoiceNumber($request);

        Invoice::create([
            'kode' => $request->kode,
            'no_invoice' => $request->no_invoice,
            'pelanggan_id' => $request->pelanggan_id,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'stok_id' => $request->stok_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'pembayaran_awal' => $request->pembayaran_awal,
            'status' => "BELUM LUNAS",
        ]);

        return redirect()->route('invoice.index')->with('success', 'Data invoice berhasil ditambahkan');
    }
}
