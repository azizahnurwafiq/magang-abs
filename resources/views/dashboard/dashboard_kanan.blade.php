@extends('dashboard.template')
@section('dashboard_kanan')

<!-- Content Header (Page header) -->
@if (request()->is('manager*'))
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Manager</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <!-- Dashboard Milik Manager -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><span>Rp.</span>{{ number_format($totalInvoiceTahun ?? 0, 0, ',', '.') }}</h3>
                    <p>
                        <span>Income Keseluruhan Perusahaan Di Tahun : {{ \Carbon\Carbon::now()->format('Y') }} </span>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard" onclick="toggleRekap()" style="cursor: pointer;"></i>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlahInvoiceTahun ?? 0 }}<span> Pesanan</span></h3>
                    <p>
                        <span>Jumlah Pesanan Belum Lunas Di Tahun : {{ \Carbon\Carbon::now()->format('Y') }}</span>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><span>Rp.</span>{{ number_format($totaltahunTax ?? 0, 0, ',', '.') }}</h3>
                    <p>
                        <span>Income Perusahaan A</span><br>
                        <span>Pada Tahun : </span>
                        <span>{{ \Carbon\Carbon::now()->format('Y') }}</span>
                    </p>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><span>Rp.</span>{{ number_format($totalbulanTax ?? 0, 0, ',', '.') }}</h3>
                    <p>
                        <span>Income Perusahaan A</span><br>
                        <span>Pada Bulan : </span>
                        <span>{{ \Carbon\Carbon::now()->format('F') }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><span>Rp.</span>{{ number_format($totaltahunNon_tax ?? 0, 0, ',', '.') }}</h3>
                    <p>
                        <span>Income Perusahaan B</span><br>
                        <span>Pada Tahun : </span>
                        <span>{{ \Carbon\Carbon::now()->format('Y') }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><span>Rp.</span>{{ number_format($totalbulanNon_tax ?? 0, 0, ',', '.') }}</h3>
                    <p>
                        <span>Income Perusahaan B</span><br>
                        <span>Pada Bulan : </span>
                        <span>{{ \Carbon\Carbon::now()->format('F') }}</span>
                    </p>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Rekap -->
    <div class="row">
        <!-- Perusahaan A -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Rekap Keseluruhan Pesanan Tax</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Penjualan Tax Tahun : {{ \Carbon\Carbon::now()->format('Y') }}</strong>
                            </p>

                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart1" height="250" style="height: 180px; display: block; width: 532px;" width="1000px" class="chartjs-render-monitor"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- Perusahaan B -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Rekap Keseluruhan Pesanan Non-Tax</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Penjualan Non-Tax Tahun : {{ \Carbon\Carbon::now()->format('Y') }} </strong>
                            </p>

                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart2" height="250" style="height: 180px; display: block; width: 532px;" width="1000px" class="chartjs-render-monitor"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- Rekap-->


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Stok Barang Terbatas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">NO</th>
                                    <th>SKU</th>
                                    <th>Kategori</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dashboard as $index => $data)
                                <tr>
                                    <td>{{$index + $dashboard->firstItem()}}</td>
                                    <td>{{$data->SKU}}</td>
                                    <td>{{$data?->kategori->kategori ?? 'Kategori tidak tersedia'}}</td>
                                    <td>{{$data->item}}</td>
                                    <td>{{$data->stokHistories->last()?->total_stok ?? 'Total stok tidak tersedia'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- Content Header (Page header) -->
@elseif (request()->is('admin*'))
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Admin</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <!-- Dashboard Milik Manager -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $sumOrders ?? 0 }}<span> Pesanan</span></h3>
                    <p>
                        <span>Jumlah Keseluruhan Pesanan Pada Bulan : </span>
                        <span>{{ \Carbon\Carbon::now()->format('F') }}</span>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $ordersNotCompleted ?? 0 }}<span> Pesanan</span></h3>
                    <p>Jumlah Pesanan On-Progress</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->

            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Stok Barang Terbatas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">NO</th>
                                    <th>SKU</th>
                                    <th>Kategori</th>
                                    <th>Item</th>
                                    <th>jumlah</th>
                                </tr>
                            </thead>
                            <tbo<tbody>
                                @forelse ($dashboard as $index => $data)
                                <tr>
                                    <td>{{$index + $dashboard->firstItem()}}</td>
                                    <td>{{$data->SKU}}</td>
                                    <td>{{$data?->kategori->kategori ?? 'Kategori tidak tersedia'}}</td>
                                    <td>{{$data->item}}</td>
                                    <td>{{$data->stokHistories->last()?->total_stok ?? 'Total stok tidak tersedia'}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- Content Header (Page header) -->
@elseif (request()->is('produksi*'))
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Produksi</h1>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pre-Order Terdekat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">NO</th>
                                <th>SKU</th>
                                <th>Kategori</th>
                                <th>Item</th>
                                <th>Warna</th>
                                <th>jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @forelse ($dashboard as $index => $data) -->
                            <tr>
                                <td>1.</td>
                                <td>wnksmwxnwino</td>
                                <td>Futijmxo</td>
                                <td>jsowxmo</td>
                                <td>nxiokmc</td>
                            </tr>
                            <!-- @endforeach -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


{{--
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'produksi' || auth()->user()->role === 'manager')
          
        @endif --}}

<style>
    .chart-container {
        position: relative;
        height: 180px;
        width: 100%;
    }
</style>

<!-- Tambahkan Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script untuk membuat grafik -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari server
        const monthlySalesTax = @json($monthlySalesTax);
        const monthlySalesNonTax = @json($monthlySalesNonTax);

        // Fungsi untuk membuat grafik pertama
        const ctx1 = document.getElementById('salesChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Sales Tax',
                    data: monthlySalesTax,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fungsi untuk membuat grafik kedua
        const ctx2 = document.getElementById('salesChart2').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Sales Non-Tax',
                    data: monthlySalesNonTax,
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection