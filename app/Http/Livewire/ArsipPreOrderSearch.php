<?php

namespace App\Http\Livewire;

use App\Models\PreOrder;
use App\Models\PreOrderArsip;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class ArsipPreOrderSearch extends Component
{
    public $keyword;

    public function render()
    {
        if ($this->keyword != null) {
            $detailArsips = PreOrder::with(['invoice', 'detailArsips.pekerjaan'])
                ->where('nama_pelanggan', 'LIKE', '%' . $this->keyword . '%')
                ->orWhere('judul_artikel', 'LIKE', '%' . $this->keyword . '%')
                ->orWhereHas('invoice', function ($q) {
                    $q->where('no_invoice', 'LIKE', '%' . $this->keyword . '%');
                })
                ->orWhereHas('detailArsips.pekerjaan', function ($q) {
                    $q->where('jenis_pekerjaan', 'LIKE', '%' . $this->keyword . '%');
                })
                ->get();

            // Flatten details dan tambahkan relasi PreOrder
            // $details = $details->flatMap(function ($preOrder) {
            //     return $preOrder->details->map(function ($detail) use ($preOrder) {
            //         $detail->preOrder = $preOrder;
            //         return $detail;
            //     });
            // });

            // Sorting berdasarkan deadline
            // $details = $details->sortByDesc(function ($detail) {
            //     $deadlineDate = Carbon::parse($detail->deadline); // Parsing deadline
            //     $daysLeft = $deadlineDate->diffInDays(Carbon::today(), false);
            //     // Prioritas berdasarkan status
            //     if ($daysLeft < 0) {
            //         return $daysLeft; // Melewati deadline (nilai negatif lebih dulu)
            //     } elseif ($daysLeft === 0) {
            //         return 0; // Hari ini
            //     } else {
            //         return $daysLeft; // Urutkan berdasarkan jarak hari
            //     }
            // });
        } else {
            // Jika tidak ada pencarian
            $arsips = PreOrder::with(['invoice', 'detailArsips.pekerjaan'])->get();

            $detailArsips = $arsips->flatMap(function ($preOrder) {
                return $preOrder->detailArsips->map(function ($detail) use ($preOrder) {
                    $detail->preOrder = $preOrder;
                    return $detail;
                });
            });

            // Sorting berdasarkan deadline
            // $details = $details->sortByDesc(function ($detail) {
            //     $deadlineDate = Carbon::parse($detail->deadline); // Parsing deadline
            //     $daysLeft = $deadlineDate->diffInDays(Carbon::today(), false);
            //     if ($daysLeft < 0) {
            //         return $daysLeft; // Melewati deadline (nilai negatif lebih dulu)
            //     } elseif ($daysLeft === 0) {
            //         return 0; // Hari ini
            //     } else {
            //         return $daysLeft; // Urutkan berdasarkan jarak hari
            //     }

            //     $details = $details->sortBy(function ($detail) {
            //         $deadlineDate = Carbon::parse($detail->deadline, false); // Parsing dengan default null jika invalid
            //         if (!$deadlineDate) {
            //             return PHP_INT_MAX; // Prioritas terendah untuk tanggal kosong
            //         }
            //         $daysLeft = $deadlineDate->diffInDays(Carbon::today(), false);
            //         return $daysLeft < 0 ? $daysLeft : $daysLeft;
            //     });
            // });
        }

        // Tambahkan pagination manual
        $page = request()->get('page', 1); // Halaman saat ini
        $perPage = 10; // Jumlah item per halaman
        $pagedDetails = $detailArsips->slice(($page - 1) * $perPage, $perPage)->values(); // Ambil data untuk halaman tertentu

        $detailsPaginated = new LengthAwarePaginator(
            $pagedDetails,
            $detailArsips->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('livewire.arsip-pre-order-search', ['detailArsips' => $detailsPaginated]);
    }
}
