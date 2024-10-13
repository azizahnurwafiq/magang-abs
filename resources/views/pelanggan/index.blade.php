@extends('dashboard.template')
@section('title', 'Data pelanggan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pelanggan</h3>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-2">
                    <a href="{{route('pelanggan.create')}}" class="btn btn-primary m-2">+ Tambah Data</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor WA</th>
                        <th>Alamat</th>
                        <th>Note</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggans as $index => $pelanggan)
                        <tr>
                            <td>{{$index + $pelanggans->firstItem()}}</td>
                            <td>{{$pelanggan->nama}}</td>
                            <td>{{$pelanggan->email}}</td>
                            <td>{{$pelanggan->no_WA}}</td>
                            <td>{{$pelanggan->alamat}}</td>
                            <td class="note">{{$pelanggan->note}}</td>
                            <td>
                                <a href="{{route('pelanggan.edit', $pelanggan->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-danger m-1" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                            </td>
                        @empty
                            <td colspan="9" class="text-center">Data Pelanggan Belum Ada !</td>
                        @endforelse
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- Pagination Link -->
                <div class="d-flex justify-content-end mx-5">
                    {{ $pelanggans->links() }}
                </div>
            </div>
        </div>
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
                Apakah Anda yakin ingin menghapus data ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <!-- Form Hapus -->
                <form action="{{route('pelanggan.destroy', $pelanggan->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('css')
    <style>
        .note{
            max-width: 200px;
        }
    </style>
@endpush