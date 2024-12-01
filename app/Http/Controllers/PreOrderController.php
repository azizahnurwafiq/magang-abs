<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pekerjaan;
use App\Models\Pelanggan;
use App\Models\PreOrder;
use App\Models\PreOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PreOrderController extends Controller
{
    public function index()
    {
        return view('pre_order.index');
    }

    public function create()
    {
        $pekerjaans = Pekerjaan::all();
        $invoices = Invoice::all();
        return view('pre_order.create', compact('invoices', 'pekerjaans'));
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

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'bahan' => 'required',
            'model' => 'required',
            // 'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'tanggal.required' => 'tanggal wajib diisi !!',
            'bahan.required' => 'bahan wajib diisi !!',
            'model.required' => 'model wajib diisi !!',
        ]);

        $data = [
            'invoice_id' => $request->invoice_id,
            'nama_pelanggan' => $request->pelanggan,
            'judul_artikel' => $request->judul,
            'tanggal' => $request->tanggal,
            'bahan' => $request->bahan,
            'warna' => $request->warna,
            'model' => $request->model,
        ];

        // simpan data ke tabel pre order
        $preOrder = PreOrder::create($data);

        // ambil data dari request
        $pekerjaan = $request->jenis_pekerjaan;
        $deadline = $request->deadline;
        $item = $request->item;
        $quantity = $request->quantity;
        $size = $request->size;
        $jumlah = $request->jumlah;
        $deskripsi = $request->deskripsi;
        $note = $request->note;

        if (count($item) === count($quantity)) {
            $detailsData = [];

            if (count($pekerjaan) === 1) {
                // kondisi pekerjaan hanya satu
                $jobId = $pekerjaan[0];
                $job = Pekerjaan::where('id', $jobId)->first();

                if (!$job) {
                    return response()->json(['error' => "Pekerjaan dengan ID {$jobId} tidak ditemukan."], 404);
                }

                foreach ($item as $index => $itemPreOrder) {
                    $quantityItem = intval($quantity[$index]);
                    $deadlinePekerjaan = $deadline[0] ?? now();

                    $detailsData[] = [
                        'pre_order_id' => $preOrder->id,
                        'pekerjaan_id' => $job->id,
                        'item' => $itemPreOrder,
                        'quantity' => $quantityItem,
                        'deadline' => $deadlinePekerjaan,
                        'status' => 'BUTUH DIKERJAKAN',
                        'note' => $note,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $imageData = [];
                    if ($request->hasFile('image')) {
                        foreach ($request->file('image') as $file) {
                            $path = $file->store('pre_order_images', 'public');
                            $imageData[] = [
                                'pre_order_id' => $preOrder->id,
                                'image' => $path ?? null,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                }
            } else if (count($pekerjaan) === count($item)) {
                // kondisi pekerjaan sama banyak dengan item
                foreach ($item as $index => $itemPreOrder) {
                    $jobId = $pekerjaan[$index];
                    $job = Pekerjaan::where('id', $jobId)->first();

                    if (!$job) {
                        return response()->json(['error' => "Pekerjaan dengan ID {$jobId} tidak ditemukan."], 404);
                    }

                    $quantityItem = intval($quantity[$index]);
                    $deadlinePekerjaan = $deadline[$index] ?? now();

                    $detailsData[] = [
                        'pre_order_id' => $preOrder->id,
                        'pekerjaan_id' => $job->id,
                        'item' => $itemPreOrder,
                        'quantity' => $quantityItem,
                        'deadline' => $deadlinePekerjaan,
                        'status' => 'BUTUH DIKERJAKAN',
                        'note' => $note,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $imageData = [];
                    if ($request->hasFile('image')) {
                        foreach ($request->file('image') as $file) {
                            $path = $file->store('pre_order_images', 'public');
                            $imageData[] = [
                                'pre_order_id' => $preOrder->id,
                                'image' => $path ?? null,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                }
            }
            // simpan ke tabel pre order detail
            DB::table('pre_order_details')->insert($detailsData);

            // simpan gambar ke tabel pre order images
            DB::table('pre_order_images')->insert($imageData);
        } else {
            return response()->json(['error' => 'Data item, quantity, jenis pekerjaan, dan deadline harus memiliki panjang yang sesuai.'], 400);
        }

        $sizeData = [];
        if (count($size) === count($jumlah) && count($jumlah) === count($deskripsi)) {
            foreach ($size as $index => $singleSize) {
                $sizeData[] = [
                    'pre_order_id' => $preOrder->id,
                    'size' => $singleSize,
                    'jumlah' => intval($jumlah[$index]),
                    'deskripsi' => $deskripsi[$index] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            // simpan size, jumlah, dan dekripsi ke tabel pre order size
            DB::table('pre_order_sizes')->insert($sizeData);
        } else {
            return response()->json(['error' => 'Jumlah data size, jumlah, dan deskripsi tidak sama.'], 400);
        }
        return redirect()->route('preOrder.index')->with('success', 'Berhasil membuat data PO');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $preOrderDetail = PreOrderDetail::findOrFail($id);
        $preOrderDetail->status = $validated['status'];
        $preOrderDetail->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $preOrderDetail = PreOrderDetail::findOrFail($id);

        if (!$preOrderDetail) {
            return response()->json(['status' => 'Data PO tidak ditemukan!'], 404);
        }

        $preOrderDetail->delete();

        return response()->json(['status' => 'Data PO berhasil dihapus!']);
    }
}
