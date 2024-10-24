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
                    <h3>100<span> Pesanan</span></h3>
                    <p>
                        <span>Jumlah Pesanan Keseluruhan </span>
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
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
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
@endsection