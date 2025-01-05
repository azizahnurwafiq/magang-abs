<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceArsip;
use Illuminate\Http\Request;

class ArsipInvoiceController extends Controller
{
    public function index()
    {
        $arsips = InvoiceArsip::sortable()->paginate(5);
        return view('invoice.arsip', compact('arsips'));
    }

    public function restore($id)
    {
        $arsip = InvoiceArsip::findOrFail($id);

        try {
            $originalInvoice = $arsip->no_invoice;

            if (Invoice::where('no_invoice', $arsip->no_invoice)->exists()) {
                $arsip->no_invoice = $originalInvoice . ' - RESTORE';

                $counter = 1;
                while (Invoice::where('no_invoice', $arsip->no_invoice)->exists()) {
                    $arsip->no_invoice = $originalInvoice . ' - RESTORE - ' . $counter;
                    $counter++;
                }
            }

            Invoice::create($arsip->toArray());

            $arsip->delete();

            if (auth()->user()->role === 'manager') {
                return redirect()->route('manager.archive.invoice')->with('success', 'invoice berhasil dipulihkan');
            } else if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.archive.invoice')->with('success', 'invoice berhasil dipulihkan');
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $hapus = InvoiceArsip::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Arsip invoice berhasil dihapus!']);
    }
}
