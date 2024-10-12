@extends('dashboard.template')
@section('stok_barang')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Stok Barang</h3>
            </div>
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
                <tr>
                  <td>1.</td>
                  <td>SKN-7492-HF3</td>
                  <td>Baju</td>
                  <td>Fukuno Basic XL</td>
                  <td>biru</td>
                  <td>10 pcs</td>
                  <td>10-12-2024</td>
                  <td>Rp 100.000</td>
                  <td>Rp 120.000</td>
                  <td>
                    
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection