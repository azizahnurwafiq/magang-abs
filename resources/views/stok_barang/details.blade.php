@extends('dashboard.template')
@section('title', 'Detail stok barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Detail stok barang</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="kategori" class="form-label">SKU</label>
                                <p>
                                    {{$stok->SKU}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Kategori</label>
                                <p>
                                    {{$stok->kategori->kategori}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Item</label>
                                <p>
                                    {{$stok->item}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Jumlah Stok Keseluruhan</label>
                                <p>
                                    {{$stok->jumlah}} Pcs
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Harga Beli</label>
                                <p>
                                    @rupiah($stok->harga_beli)
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Harga Jual</label>
                                <p>
                                    @rupiah($stok->harga_jual)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal Masuk Stok</th>
                                    <th>Jumlah Stok Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$stok->tanggal_masuk}}</td>
                                    <td>{{$stok->jumlah}} <span>Pcs</span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <a href="{{route('stok_barang.barang')}}" class="btn btn-primary m-2">Kembali</a>
        </div>
        <div class="col-md-12">

        </div>
    </div>
</div>
@endsection