@extends('dashboard.template')
@section('dashboard_kanan')

<!-- Content Header (Page header) -->
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
                    <h3><span>Rp. </span>10.000.000</h3>
                    <p>
                        <span>Income Perusahaan A </span>
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
                    <h3>100<span> Pesanan</span></h3>
                    <p>
                        <span>Jumlah Pesanan Belum Lunas</span>
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
                    <h3><span>Rp.</span>100.000.000</h3>
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
                    <h3><span>Rp.</span>15.000.000</h3>
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
                    <h3>Rp.15.000.000</h3>
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
                    <h3>Rp.15.000.000</h3>
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
                    <h5 class="card-title">Rekap Keseluruhan Perusahaan A</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="9inhn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
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
                <!-- ./card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                <h5 class="description-header">$35,210.43</h5>
                                <span class="description-text">TOTAL REVENUE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 0%</span>
                                <h5 class="description-header">$10,390.90</h5>
                                <span class="description-text">TOTAL COST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- Perusahaan B -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Rekap Keseluruhan Perusahaan B</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="9inhn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
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
                <!-- ./card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                <h5 class="description-header">$35,210.43</h5>
                                <span class="description-text">TOTAL REVENUE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 0%</span>
                                <h5 class="description-header">$10,390.90</h5>
                                <span class="description-text">TOTAL COST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
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
                                    <th>Warna</th>
                                    <th>jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>wnksmwxnwino</td>
                                    <td>Futijmxo</td>
                                    <td>jsowxmo</td>
                                    <td>nxiokmc</td>
                                    <td>20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- Content Header (Page header) -->
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
                    <h3>100<span> Pesanan</span></h3>
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
                    <h3>150<span> Pesanan</span></h3>
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
                                    <th>Warna</th>
                                    <th>jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>wnksmwxnwino</td>
                                    <td>Futijmxo</td>
                                    <td>jsowxmo</td>
                                    <td>nxiokmc</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- Content Header (Page header) -->
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
                            <tr>
                                <td>1.</td>
                                <td>wnksmwxnwino</td>
                                <td>Futijmxo</td>
                                <td>jsowxmo</td>
                                <td>nxiokmc</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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
        // Fungsi untuk membuat grafik pertama
        const ctx1 = document.getElementById('salesChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Sales 1',
                    data: [65, 59, 80, 81, 56, 55, 40],
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
                    label: 'Sales 2',
                    data: [45, 39, 60, 71, 46, 35, 30],
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