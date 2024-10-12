@extends('dashboard.template')
@section('stok_barang')

<div class="container-fluid py-4">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Stok Barang</h3>
          </div>
          <div class="d-flex justify-content-center mt-3">
            <button id="showFormStokBaru" class="btn btn-primary m-2 col-md-2">Stok Baru</button>
            <button id="showFormStokLama" class="btn btn-primary m-2 col-md-2">Stok Lama</button>
          </div>
          <!-- /.card-header -->

          <div id="stokBaru">
            <form method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">SKU</label>
                  <input type="text" name="nama_stok" class="form-control" id="exampleInputEmail1" placeholder="SKU">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kategori</label>
                  <input type="text" name="model" class="form-control" id="exampleInputEmail1" placeholder="kategori">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Item</label>
                  <input type="text" name="model" class="form-control" id="exampleInputEmail1" placeholder="item">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Warna</label>
                  <input type="text" name="warna" class="form-control" id="exampleInputEmail1" placeholder="warna">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Jumlah</label>
                  <input type="number" name="jumlah" min="0" class="form-control" id="exampleInputEmail1" placeholder="jumlah">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal Masuk</label>
                  <input type="date" name="date" class="form-control" id="exampleInputEmail1" placeholder="tanggal masuk">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga Beli</label>
                  <input type="number" name="date" min="0" class="form-control" id="exampleInputEmail1" placeholder="harga beli">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga Jual</label>
                  <input type="number" name="date" min="0" class="form-control" id="exampleInputEmail1" placeholder="harga jual">
                </div>
              </div>
                <button type="submit" class="btn btn-primary ml-3 mt-3">Submit</button>
            </form>
          </div>

          
          <div id="stokLama">
            <form method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">SKU</label>
                  <input type="text" name="nama_stok" class="form-control" id="exampleInputEmail1" placeholder="SKU">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kategori</label>
                  <input type="text" name="model" class="form-control" id="exampleInputEmail1" placeholder="kategori">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Item</label>
                  <input type="text" name="model" class="form-control" id="exampleInputEmail1" placeholder="item">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Warna</label>
                  <input type="text" name="warna" class="form-control" id="exampleInputEmail1" placeholder="warna">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Jumlah</label>
                  <input type="number" name="jumlah" min="0" class="form-control" id="exampleInputEmail1" placeholder="jumlah">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal Masuk</label>
                  <input type="date" name="date" class="form-control" id="exampleInputEmail1" placeholder="tanggal masuk">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga Beli</label>
                  <input type="number" name="date" min="0" class="form-control" id="exampleInputEmail1" placeholder="harga beli">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga Jual</label>
                  <input type="number" name="date" min="0" class="form-control" id="exampleInputEmail1" placeholder="harga jual">
                </div>
              </div>
                <button type="submit" class="btn btn-primary ml-3 mt-3">Submit</button>
            </form>
          </div>

        </div>
      </div>
    </div>
</div>
@endsection



@push('css')
    <style>
      #stokBaru {
        opacity: 0;
        height: 0;
        overflow: hidden;
        transition: opacity 0.5s ease-in-out, height 0.5s ease-out;
      }
      #stokBaru.active {
        opacity: 1;
        height: 815px;
      }

      #stokLama {
        opacity: 0;
        height: 0;
        overflow: hidden;
        transition: opacity 0.5s ease-in-out, height 0.5s ease-out;
      }
      #stokLama.active {
        opacity: 1;
        height: 815px;
      }


    </style>
@endpush



@push('scripts')
    <script>
      document.getElementById('showFormStokBaru').addEventListener('click', function() {
        let form = document.getElementById('stokBaru');
        if (!form.classList.contains('active')) {
          form.classList.add('active'); 
        } else {
          form.classList.remove('active');
        }
      });

      document.getElementById('showFormStokLama').addEventListener('click', function() {
        let form = document.getElementById('stokLama');
        if (!form.classList.contains('active')) {
          form.classList.add('active'); 
        } else {
          form.classList.remove('active');
        }
      });
    </script>
@endpush