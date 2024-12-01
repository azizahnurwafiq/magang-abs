<?php

namespace App\Http\Livewire;

use App\Models\PreOrder;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class PreOrderSearch extends Component
{
    public $keyword;

    public function render()
    {
        if ($this->keyword != null) {
            $details = PreOrder::with(['invoice', 'details.pekerjaan'])
                ->where('nama_pelanggan', 'LIKE', '%' . $this->keyword . '%')
                ->orWhere('judul_artikel', 'LIKE', '%' . $this->keyword . '%')
                ->orWhereHas('invoice', function ($q) {
                    $q->where('no_invoice', 'LIKE', '%' . $this->keyword . '%');
                })
                ->orWhereHas('details.pekerjaan', function ($q) {
                    $q->where('jenis_pekerjaan', 'LIKE', '%' . $this->keyword . '%');
                })
                ->get();

            // Flatten details dan tambahkan relasi PreOrder
            $details = $details->flatMap(function ($preOrder) {
                return $preOrder->details->map(function ($detail) use ($preOrder) {
                    $detail->preOrder = $preOrder;
                    return $detail;
                });
            });

            // Sorting berdasarkan deadline
            $details = $details->sortBy(function ($detail) {
                return Carbon::parse($detail->deadline)->diffInDays(Carbon::today());
            });
        } else {
            // Jika tidak ada pencarian
            $preOrders = PreOrder::with(['invoice', 'details.pekerjaan'])->get();

            $details = $preOrders->flatMap(function ($preOrder) {
                return $preOrder->details->map(function ($detail) use ($preOrder) {
                    $detail->preOrder = $preOrder;
                    return $detail;
                });
            });

            // Sorting berdasarkan deadline
            $details = $details->sortBy(function ($detail) {
                return Carbon::parse($detail->deadline)->diffInDays(Carbon::today());
            });
        }

        // Tambahkan pagination manual
        $page = request()->get('page', 1); // Halaman saat ini
        $perPage = 5; // Jumlah item per halaman
        $pagedDetails = $details->slice(($page - 1) * $perPage, $perPage)->values(); // Ambil data untuk halaman tertentu

        $detailsPaginated = new LengthAwarePaginator(
            $pagedDetails,
            $details->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('livewire.pre-order-search', ['details' => $detailsPaginated]);
    }
}
