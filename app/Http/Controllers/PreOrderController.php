<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function index()
    {
        return view('pre_order.index');
    }

    public function create()
    {
        $invoices = Invoice::all();
        return view('pre_order.create', compact('invoices'));
    }

    public function getNamaPelanggan($id)
    {
        $invoice = Invoice::with('pelanggan')->find($id);

        if (!$invoice || !$invoice->pelanggan) {
            return response()->json(['error' => 'Invoice atau pelanggan tidak ditemukan'], 404);
        }

        return response()->json([
            'pelanggan' => $invoice->pelanggan->nama,
            'judul' => $invoice->judul
        ]);
    }

    public function getInvoiceItems($id)
    {
        $invoice = Invoice::with('invoice_stoks')->find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice tidak ditemukan'], 404);
        }

        $items = $invoice->invoice_stoks->map(function ($item) {
            return [
                'item' => $item->stok->item,
                'quantity' => $item->jumlah
            ];
        });
        return response()->json(['items' => $items]);
    }
}
