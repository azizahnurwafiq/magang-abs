@extends('dashboard.template')
@section('title', 'Tambah data barang')

@section('content')
<div class="container-fluid py-4 ">
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
              <form action="{{route('stok_barang.store')}}" id="stokBaruForm" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="SKU">SKU</label>
                    <input type="text" name="SKU" id="SKU" class="form-control" placeholder="SKU" required>
                    {{-- @error('SKU')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" placeholder="kategori" required>
                    {{-- @error('kategori')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" name="item" id="item" class="form-control" placeholder="item" required>
                    {{-- @error('item')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" name="warna" id="warna" placeholder="warna" class="form-control" required>
                    {{-- @error('warna')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" min="0" class="form-control" placeholder="jumlah" required>
                    {{-- @error('jumlah')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" placeholder="tanggal masuk" required>
                    {{-- @error('tanggal_masuk')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="number" name="harga_beli" id="harga_beli" min="0" class="form-control" placeholder="harga beli" required>
                  </div>
                  <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" name="harga_jual" id="harga_jual" min="0" class="form-control" placeholder="harga jual" required>
                    {{-- @error('harga_jual')
                      <div class="form-text text-danger">{{$message}}</div>
                    @enderror --}}
                  </div>
                </div>
                  <button type="submit" class="btn btn-primary mx-4 my-4">Submit</button>
              </form>
            </div>
          
          <div id="stokLama">
            <form id="stokLamaForm" method="POST">
              @csrf
              <div class="card-body">
                
                <div class="form-group">
                  <label for="SKU" class="form-label d-block">kategori</label>
                  <select class="form-control" aria-label="Default select example" name="SKU" id="SKU">
                    <option selected>Pilih kategori</option>
                    @foreach ($datas as $data)
                        <option value={{$data->kategori}}>{{$data->kategori}}</option>    
                    @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                  <label for="SKU" class="form-label d-block">item</label>
                  <select class="form-control" aria-label="Default select example" name="SKU" id="SKU">
                    <option selected>Pilih item</option>
                    @foreach ($datas as $data)
                        <option value={{$data->item}}>{{$data->item}}</option>    
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="SKU" class="form-label d-block">warna</label>
                  <select class="form-control" aria-label="Default select example" name="SKU" id="SKU">
                    <option selected>Pilih warna</option>
                    @foreach ($datas as $data)
                        <option value={{$data->warna}}>{{$data->warna}}</option>    
                    @endforeach
                    </select>
                </div>
              
                <div class="form-group">
                  <label for="SKU" class="form-label d-block">Jumlah</label>
                  <select class="form-control" aria-label="Default select example" name="SKU" id="SKU">
                    <option selected>pilih jumlah</option>
                    @foreach ($datas as $data)
                        <option value={{$data->jumlah}}>{{$data->jumlah}}</option>    
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="SKU" class="form-label d-block">Tanggal Masuk</label>
                  <select class="form-control" aria-label="Default select example" name="SKU" id="SKU">
                    <option selected>Pilih tanggal masuk</option>
                    @foreach ($datas as $data)
                        <option value={{$data->tanggal_masuk}}>{{$data->tanggal_masuk}}</option>    
                    @endforeach
                    </select>
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
        transition: opacity 0.5s ease, height 0.5s ease;
      }
      #stokBaru.active {
        opacity: 1;
        height: auto;
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

      // let SKU = document.getElementById('SKU');
      // let kategori = document.getElementById('kategori');
      // let item = document.getElementById('item');
      // let warna = document.getElementById('warna');
      // let jumlah = document.getElementById('jumlah');
      // let tanggal_masuk = document.getElementById('tanggal_masuk');
      // let harga_beli = document.getElementById('harga_beli');
      // let harga_jual = document.getElementById('harga_jual');

      // document.getElementById('stokBaruForm').addEventListener('submit', function(e){
      //   if(!SKU || !kategori || !item || !warna || !jumlah || !tanggal_masuk || !harga_beli || !harga_jual){
      //     e.preventDefault();
      //   } 
      // });





      document.getElementById('showFormStokLama').addEventListener('click', function() {
        let form = document.getElementById('stokLama');
        if (!form.classList.contains('active')) {
          form.classList.add('active'); 
        } else {
          form.classList.remove('active');
        }
      });

      document.getElementById('stokLamaForm').addEventListener('submit', function(e){
        e.preventDefault();
      });
    </script>
@endpush