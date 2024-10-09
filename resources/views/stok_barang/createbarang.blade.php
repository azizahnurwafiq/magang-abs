@extends('dashboard.template')
@section('stok_barang')
<div class="container-fluid py-4">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Stok Barang</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="quickForm">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Stok</label>
                <input type="nama_stok" name="nama_stok" class="form-control" id="exampleInputEmail1" placeholder="Enter nama_stok">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Model</label>
                <input type="model" name="model" class="form-control" id="exampleInputEmail1" placeholder="Enter model">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Warna</label>
                <input type="warna" name="warna" class="form-control" id="exampleInputEmail1" placeholder="Enter warna">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Jumlah</label>
                <input type="jumlah" name="jumlah" class="form-control" id="exampleInputEmail1" placeholder="Enter jumlah">
              </div>
              <div class="form-group mb-0">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                  <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection