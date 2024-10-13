@extends('dashboard.template')
@section('title', 'Stok Barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Stok Barang</h3>
            </div>
            @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif

            <div class="col-2">
                <a href="{{route('stok_barang.create')}}" class="btn btn-primary m-2">+ Tambah Data</a>
            </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>SKU</th>
                  <th>kategori</th>
                  <th>Item</th>
                  <th>Warna</th>
                  <th>Jumlah</th>
                  <th>Tanggal Masuk</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($datas as $index => $data)
                  <tr>
                    <td>{{$index + $datas->firstItem()}}</td>
                    <td>{{$data->SKU}}</td>
                    <td>{{$data->kategori}}</td>
                    <td>{{$data->item}}</td>
                    <td>{{$data->warna}}</td>
                    <td>{{$data->jumlah}}</td>
                    <td>{{$data->tanggal_masuk}}</td>
                    <td>{{$data->harga_beli}}</td>
                    <td>{{$data->harga_jual}}</td>
                    <td>
                      <a href="#" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                      <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                      <a href="#" class="btn btn-danger m-1"><i class="fa fa-trash"></i></a>
                    </td>
                @empty
                  <td colspan="9" class="text-center">Data Stok Belum Ada !</td>
                @endforelse
                </tr>
              </tbody>
            </table>
          </div>
           <!-- Pagination Link -->
           <div class="d-flex justify-content-end mx-5">
            {{ $datas->links() }}
        </div>
        </div>
      </div>
    </div>
</div>
@endsection