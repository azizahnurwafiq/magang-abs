<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceArsip;
use App\Models\InvoicePayment;
use App\Models\Pelanggan;
use App\Models\Stok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $data['invoices'] = Invoice::sortable()->paginate(10);
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

        $invoicePrefix = $kode === 'non_tax' ? 'INST' : 'FKN';

        $nomorInvoice = "{$invoicePrefix}/{$combinedDate}/{$nextSequence}";

        return response()->json(['no_invoice' => $nomorInvoice]);
    }


    public function store(Request $request)
    {

        // $no_invoice = $this->generateInvoiceNumber($request);
        $request->validate([
            'judul' => 'required|max:255',
            'jumlah' => 'required|min:1|max:20',
            'down_payment' => 'required|numeric|min:1',
        ], [
            'judul.required' => 'judul wajib diisi !!',
            'judul.max' => 'judul tidak boleh lebih dari 255 karakter !!',
            'jumlah.required' => 'Jumlah wajib diisi !!',
            'jumlah.min' => 'Jumlah harus minimal 1 !!',
            'jumlah.max' => 'Jumlah tidak boleh lebih dari 20 karakter !!',
            'down_payment.required' => 'down payment wajib diisi !!',
            'down_payment.numeric' => 'Down payment harus berupa angka !!',
            'down_payment.min' => 'down payment harus minimal 1 !!',
        ]);

        $kekuranganBayar = $request->down_payment;

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
                $hargaItem = intval($harga[$index]);
                $jumlahItem = intval($jumlah[$index]);
                $totalItem = $hargaItem * $jumlahItem;

                $attachData[$stokId] = [
                    'harga' => $hargaItem,
                    'jumlah' => $jumlahItem,
                    'total' => $totalItem,
                ];
            }
            $invoice->stoks()->attach($attachData);
        } else {
            return response()->json(['error' => 'Data item, harga, dan jumlah harus memiliki panjang yang sama.'], 400);
        }
        return redirect()->route('admin.invoice.index')->with('success', 'Data invoice berhasil ditambahkan');
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice.detail', compact('invoice'));
    }

    public function getAlamatPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);
        return response()->json(['alamat' =>  $pelanggan->alamat]);
    }

    public function getHargaItem($id)
    {
        $stok = Stok::find($id);
        return response()->json(['harga_jual' =>  $stok->harga_jual]);
    }

    public function payment($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice.payment', compact('invoice'));
    }

    public function payment_store(Request $request, $id)
    {
        $request->validate([
            'payment' => 'required',
            'tanggal' => 'required',
            'via' => 'required',
        ], [
            'payment.required' => 'payment wajib diisi!',
            'tanggal.required' => 'tanggal wajib diisi!',
            'via.required' => 'via pembayaran wajib diisi!'
        ]);

        $invoice = Invoice::find($id);

        $payment = $request->input('payment');

        if ($payment > $invoice->kekurangan_bayar) {
            return redirect()->back()->with('error', 'Pembayaran melebihi kekurangan bayar.');
        }

        $invoice->kekurangan_bayar -= $payment;

        if ($invoice->kekurangan_bayar <= 0) {
            $invoice->status = 'LUNAS';
            $invoice->kekurangan_bayar = 0;
        }

        // simpan perubahan di invoice
        $invoice->save();

        $data = [
            'invoice_id' => $invoice->id,
            'payment' => $payment,
            'tanggal' => $request->tanggal,
            'via' => $request->via,
        ];

        InvoicePayment::create($data);

        return redirect()->route('admin.invoice.index')->with('success', 'berhasil');
    }

    public function history($id)
    {
        $invoice = Invoice::with('payments')->findOrFail($id);
        $payments = $invoice->payments;
        return view('invoice.historyPayment', compact('invoice', 'payments'));
    }

    public function editPayment($id)
    {
        $payment = InvoicePayment::find($id);
        return view('invoice.editPayment', compact('payment'));
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'payment' => 'required',
            'tanggal' => 'required',
            'via' => 'required',
        ], [
            'payment.required' => 'payment wajib diisi!',
            'tanggal.required' => 'tanggal wajib diisi!',
            'via.required' => 'via pembayaran wajib diisi!'
        ]);

        $invoicePayment = InvoicePayment::findOrFail($id);
        $invoiceId = $invoicePayment->invoice->id;

        $oldPayment = $invoicePayment->payment;
        $newPayment = $request->input('payment');
        $difference =  $newPayment - $oldPayment;

        $data = [
            'payment' => $newPayment,
            'tanggal' => $request->tanggal,
            'via' => $request->via,
        ];

        $invoicePayment->update($data);

        $invoice = Invoice::findOrFail($invoicePayment->invoice_id);

        $invoice->kekurangan_bayar -= $difference;
        $invoice->save();

        return redirect()->route('admin.invoice.history', ['id' => $invoiceId])->with('success', 'berhasil diupdate');
    }

    public function destroy($id)
    {
        $hapus = InvoicePayment::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data payment berhasil dihapus!']);
    }

    public function exportPdf($id)
    {
        $invoice = Invoice::with('invoice_stoks')->findOrFail($id);

        if (str_starts_with($invoice->no_invoice, 'INST')) {
            $pdf = PDF::loadView('invoice.export_inst', compact('invoice'))->setPaper('A4', 'portrait');
        } else if (str_starts_with($invoice->no_invoice, 'FKN')) {
            $pdf = PDF::loadView('invoice.export_fkn', compact('invoice'))->setPaper('A4', 'portrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        } else {
            return redirect()->back()->with('error', 'Prefix kode invoice tidak valid.');
        }
        return $pdf->stream('invoice_' . $invoice->no_invoice . '.pdf');
    }

    public function archive($id)
    {
        $invoice = Invoice::findOrfail($id);

        InvoiceArsip::create($invoice->toArray());

        $invoice->delete();

        return redirect()->route('admin.invoice.index')->with('success', 'invoice berhasil diarsipkan');
    }
}
