<?php

namespace App\Http\Livewire;


use App\Models\PreOrder;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class PreOrderSearch extends Component
{
    public $keyword;

    public function updatedPerPage()
    {
        $this->resetPage();
    }

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
            $details = $details->sortByDesc(function ($detail) {
                $deadlineDate = Carbon::parse($detail->deadline); // Parsing deadline
                $daysLeft = $deadlineDate->diffInDays(Carbon::today(), false);
                // Prioritas berdasarkan status
                if ($daysLeft < 0) {
                    return $daysLeft; // Melewati deadline (nilai negatif lebih dulu)
                } elseif ($daysLeft === 0) {
                    return 0; // Hari ini
                } else {
                    return $daysLeft; // Urutkan berdasarkan jarak hari
                }
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
            $details = $details->sortByDesc(function ($detail) {
                $deadlineDate = Carbon::parse($detail->deadline); // Parsing deadline
                $daysLeft = $deadlineDate->diffInDays(Carbon::today(), false);
                if ($daysLeft < 0) {
                    return $daysLeft; // Melewati deadline (nilai negatif lebih dulu)
                } elseif ($daysLeft === 0) {
                    return 0; // Hari ini
                } else {
                    return $daysLeft; // Urutkan berdasarkan jarak hari
                }

                $details = $details->sortBy(function ($detail) {
                    $deadlineDate = Carbon::parse($detail->deadline, false); // Parsing dengan default null jika invalid
                    if (!$deadlineDate) {
                        return PHP_INT_MAX; // Prioritas terendah untuk tanggal kosong
                    }
                    $daysLeft = $deadlineDate->diffInDays(Carbon::today(), false);
                    return $daysLeft < 0 ? $daysLeft : $daysLeft;
                });
            });
        }

        // Tambahkan pagination manual
        $page = request()->get('page', 1); // Halaman saat ini
        $perPage = 10; // Jumlah item per halaman
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
