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
              
            </div>
          
          <div id="stokLama">
              
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