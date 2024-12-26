<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pekerjaan;
use App\Models\PreOrder;
use App\Models\PreOrderArsip;
use App\Models\PreOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'bahan' => 'required|string|max:20|regex:/^[a-zA-Z\s]+$/',
            'model' => 'required|string|max:20|regex:/^[a-zA-Z\s]+$/',
            // 'warna' => 'required|string|max:20|regex:/^[a-zA-Z\s]+$/',
            'item' => 'required',
            // 'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'bahan.required' => 'Bahan wajib diisi !!',
            'bahan.string' => 'Bahan harus berupa teks !!',
            'bahan.max' => 'Nama bahan tidak boleh lebih dari 20 karakter !!',
            'bahan.regex' => 'Bahan hanya boleh mengandung huruf dan spasi !!',
            'model.required' => 'Model wajib diisi !!',
            'model.string' => 'Model harus berupa teks !!',
            'model.max' => 'Nama model tidak boleh lebih dari 20 karakter !!',
            'model.regex' => 'Model hanya boleh mengandung huruf dan spasi !!',
            // 'warna.required' => 'Warna wajib diisi !!',
            // 'warna.string' => 'Warna harus berupa teks !!',
            // 'warna.max' => 'Warna tidak boleh lebih dari 20 karakter !!',
            // 'warna.regex' => 'Warna hanya boleh mengandung huruf dan spasi !!',
            'item.required' => 'item wajib diisi !!'
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

        // // simpan data ke tabel pre order
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
            $imageData = [];

            // kondisi satu pekerjaan untuk semua item
            if (count($pekerjaan) === 1 && count($item) > 1) {
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
                        'item' => json_encode($item),
                        'quantity' => json_encode($quantity),
                        'deadline' => $deadlinePekerjaan,
                        'status' => 'BUTUH DIKERJAKAN',
                        'note' => $note,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $file) {
                        $path = $file->store('pre_order_images', 'public');
                        $imageData[] = [
                            'pre_order_id' => $preOrder->id,
                            'image' => $path,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
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
                        'item' => json_encode($item),
                        'quantity' => json_encode($quantity),
                        'deadline' => $deadlinePekerjaan,
                        'status' => 'BUTUH DIKERJAKAN',
                        'note' => $note,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $file) {
                        $path = $file->store('pre_order_images', 'public');
                        $imageData[] = [
                            'pre_order_id' => $preOrder->id,
                            'image' => $path,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            } else if (count($item) === 1 && count($pekerjaan) > 1) {
                // kondisi satu item untuk banyak pekerjaan
                $itemPreOrder = $item[0];
                $quantityItem = intval($quantity[0] ?? 0);

                foreach ($pekerjaan as $index => $jobId) {
                    $job = Pekerjaan::where('id', $jobId)->first();

                    if (!$job) {
                        return response()->json(['error' => "Pekerjaan dengan ID {$jobId} tidak ditemukan."], 404);
                    }

                    $deadlinePekerjaan = $deadline[$index] ?? now();

                    $detailsData[] = [
                        'pre_order_id' => $preOrder->id,
                        'pekerjaan_id' => $job->id,
                        'item' => json_encode($item),
                        'quantity' => json_encode($quantity),
                        'deadline' => $deadlinePekerjaan,
                        'status' => 'BUTUH DIKERJAKAN',
                        'note' => $note,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $file) {
                        $path = $file->store('pre_order_images', 'public');
                        $imageData[] = [
                            'pre_order_id' => $preOrder->id,
                            'image' => $path,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            } else if (count($item) > 1 && count($pekerjaan) > 1) {
                // kondisi item lebih dari satu tetapi tidak sama dengan pekerjaan dan pekerjaan tidak sama dengan item
                foreach ($pekerjaan as $jobIndex => $jobId) {
                    $job = Pekerjaan::where('id', $jobId)->first();

                    if (!$job) {
                        return response()->json(['error' => "Pekerjaan dengan ID {$jobId} tidak ditemukan."], 404);
                    }

                    // Ambil deadline berdasarkan indeks pekerjaan (jika ada)
                    $deadlinePekerjaan = $deadline[$jobIndex] ?? now();

                    // Simpan semua item sebagai satu grup untuk pekerjaan ini
                    $detailsData[] = [
                        'pre_order_id' => $preOrder->id,
                        'pekerjaan_id' => $job->id,
                        'item' => json_encode($item), // Semua item dalam satu pekerjaan
                        'quantity' => json_encode($quantity), // Kuantitas semua item
                        'deadline' => $deadlinePekerjaan,
                        'status' => 'BUTUH DIKERJAKAN',
                        'note' => $note,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $file) {
                        $path = $file->store('pre_order_images', 'public');
                        $imageData[] = [
                            'pre_order_id' => $preOrder->id,
                            'image' => $path,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            // simpan ke tabel pre order detail
            DB::table('pre_order_details')->insert($detailsData);
            // Simpan gambar ke tabel pre_order_images hanya jika ada data
            if (!empty($imageData)) {
                DB::table('pre_order_images')->insert($imageData);
            }
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
        return redirect()->route('admin.preOrder.index')->with('success', 'Berhasil membuat data PO');
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

    public function show($id)
    {
        $details = PreOrderDetail::with('preOrder.invoice', 'pekerjaan', 'preOrder.sizes')->find($id);
        return view('pre_order.details', compact('details'));
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

    public function archive($id)
    {
        $preOrderDetail = PreOrderDetail::findOrFail($id);
        // dd($preOrderDetail);
        PreOrderArsip::create($preOrderDetail->toArray());

        $preOrderDetail->delete();

        return redirect()->route('admin.preOrder.index')->with('success', 'PO berhasil diarsipkan');
    }

    public function update(Request $request, $id)
    {
        $preOrderDetail = PreOrderDetail::find($id);

        $preOrderDetail->update([
            'note_produksi' => $request->note_produksi,
        ]);

        return redirect()->route('produksi.preOrder.index')->with('success', 'Berhasil menambahkan note produksi');
    }
}
