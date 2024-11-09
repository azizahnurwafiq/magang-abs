@extends('dashboard.template')
@section('title', 'Stok Barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kategori</h3>
            </div>
            @if (session('success'))
              <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                  {{ session('success') }}
              </div>
            @endif

            <div class="col-2">
                <a href="{{route('kategori.create')}}" class="btn btn-primary m-2">+ Tambah Data</a>
            </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th  style="width: 50px">No</th>
                  <th>kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($kategoris as $index => $kategori)
                  <tr class="text-center">
                    <td>{{$index + $kategoris->firstItem()}}</td>
                    <td>{{$kategori->kategori}}</td>
                    <td>
                        <a href="{{route('kategori.edit', $kategori->id)}}" class="btn btn-primary m-2"><i class="fa fa-edit"></i> Edit</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                        
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
                                    <form action="{{route('kategori.destroy', $kategori->id)}}" method="POST">
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
                  <td colspan="9" class="text-center">Data Kategori Belum Ada !</td>
                @endforelse
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Pagination Link -->
          <div class="d-flex justify-content-end mx-5">
            {{ $kategoris->links() }}
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

