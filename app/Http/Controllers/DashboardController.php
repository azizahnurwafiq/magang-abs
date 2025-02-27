<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\PreOrder;
use App\Models\PreOrderDetail;
use App\Models\Invoice;
use App\Models\StokHistory;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $dashboard = Stok::whereHas('stokHistories', function ($query) {
        //     $query->where('total_stok', '<', 10);
        // })->paginate(10);
        
        $dashboard = Stok::whereHas('stokHistories', function ($query) {
            $query->whereRaw('total_stok < 10')
                    ->whereRaw('tanggal_masuk = (SELECT MAX(tanggal_masuk) FROM stok_histories AS sh WHERE sh.stok_id = stok_histories.stok_id)');
        })->paginate(10);
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $sumOrders = PreOrder::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $ordersNotCompleted = PreOrderDetail::whereNotIn('status', ['DONE AND READY', 'DIAMBIL'])
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $totalInvoiceTahun = \App\Models\Invoice::whereYear('created_at', Carbon::now()->year)
            ->sum('total_invoice');

        $totalInvoice = Invoice::selectRaw("
            SUM(CASE WHEN kode = 'tax' THEN total_invoice ELSE 0 END) as totalbulanTax,
            SUM(CASE WHEN kode = 'non_tax' THEN total_invoice ELSE 0 END) as totalbulanNonTax,
            SUM(CASE WHEN kode = 'tax' AND YEAR(created_at) = ? THEN total_invoice ELSE 0 END) as totaltahunTax,
            SUM(CASE WHEN kode = 'non_tax' AND YEAR(created_at) = ? THEN total_invoice ELSE 0 END) as totaltahunNonTax
        ", [Carbon::now()->year, Carbon::now()->year])
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->first();

        $totalbulanTax = $totalInvoice->totalbulanTax;
        $totalbulanNon_tax = $totalInvoice->totalbulanNonTax;
        $totaltahunTax = $totalInvoice->totaltahunTax;
        $totaltahunNon_tax = $totalInvoice->totaltahunNonTax;

        $jumlahInvoiceTahun = Invoice::whereYear('created_at', Carbon::now()->year)
            ->where('kekurangan_bayar', '>', 0)
            ->count();

        $jumlahLunas = Invoice::whereYear('created_at', Carbon::now()->year)
            ->where('kekurangan_bayar', '=', 0)
            ->count();


        $monthlySalesTax = [];
        $monthlySalesNonTax = [];
        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            // Total penjualan dengan kode = 'tax'
            $salesTax = Invoice::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->where('kode', 'tax')
                ->sum('total_invoice');
            $monthlySalesTax[] = $salesTax;

            // Total penjualan dengan kode = 'non_tax'
            $salesNonTax = Invoice::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->where('kode', 'non_tax')
                ->sum('total_invoice');
            $monthlySalesNonTax[] = $salesNonTax;
        }


        return view(
            'dashboard.dashboard_kanan',
            compact(
                'dashboard',
                'sumOrders',
                'ordersNotCompleted',
                'totalInvoiceTahun',
                'totalbulanTax',
                'totaltahunTax',
                'totalbulanNon_tax',
                'totaltahunNon_tax',
                'jumlahInvoiceTahun',
                'jumlahLunas',
                'monthlySalesTax',
                'monthlySalesNonTax'
            )
        );
    }
}
