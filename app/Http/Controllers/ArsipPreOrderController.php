<?php

namespace App\Http\Controllers;

use App\Models\PreOrderArsip;
use App\Models\PreOrderDetail;
use Illuminate\Http\Request;


class ArsipPreOrderController extends Controller
{

    public function index()
    {
        $arsips = PreOrderArsip::sortable()->paginate(2);
        return view('pre_order.arsip', compact('arsips'));
    }

    public function restore($id)
    {
        $arsip = PreOrderArsip::findOrFail($id);
        // dd($arsip);

        PreOrderDetail::create($arsip->toArray());

        $arsip->delete();

        return redirect()->route('admin.preOrderArchive.index')->with('success', 'PO berhasil dipulihkan');
    }
}
