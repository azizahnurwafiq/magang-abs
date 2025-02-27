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
                                    {{$stok->stokHistories->last()->total_stok}} Pcs
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
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jumlah Stok Masuk</th>
                                    <th>Tanggal Masuk Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stok->stokHistories as $stokHistori)
                                <tr>
                                    <td>{{$stokHistori->jumlah}} <span>Pcs</span></td>
                                    <td>{{$stokHistori->tanggal_masuk}}</td>
                                </tr>
                                @empty
                                <td colspan="2" class="text-center">Data detail Belum Ada !</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @if (request()->is('admin*'))
                <a href="{{route('admin.stok_barang.barang')}}" class="btn btn-success m-2">Kembali</a>
            @elseif (request()->is('manager*'))
                <a href="{{route('manager.stok_barang.barang')}}" class="btn btn-success m-2">Kembali</a>
            @endif
        </div>
        <div class="col-md-12">

        </div>
    </div>
</div>
@endsection