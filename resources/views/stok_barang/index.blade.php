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
              <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
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
                <tr class="text-center">
                  <th>No</th>
                  <th>SKU</th>
                  <th>kategori</th>
                  <th>Item</th>
                  <th>Warna</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($datas as $index => $data)
                  <tr class="text-center">
                    <td>{{$index + $datas->firstItem()}}</td>
                    <td>{{$data->SKU}}</td>
                    <td>{{$data->kategori}}</td>
                    <td>{{$data->item}}</td>
                    <td>{{$data->warna}}</td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                        </button>
                          <div class="dropdown-menu">
                              <a href="{{route('stok_barang.show', $data->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Details</a>
                              <a href="{{route('stok_barang.edit', $data->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-edit"></i> Edit</a>
                              <button class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                          </div>
                        </div>
                      <!-- Modal Konfirmasi Hapus -->
                      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                                    <!-- Form Hapus -->
                                    <form action="{{route('stok_barang.destroy', $data->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </div>

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

@push('css')
    <style>
      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 100px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 99;
        border-radius: 4px;
      }

      .dropdown-item {
        color: black;
        padding: 10px 20px;
        text-decoration: none;
        display: block;
      }

      .dropdown-item:hover {
        background-color: #ddd;
      }
    </style>
@endpush
