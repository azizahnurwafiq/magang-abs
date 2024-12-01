@extends('dashboard.template')
@section('title', 'Pekerjaan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-bold text-primary">DATA PEKERJAAN</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class=" d-flex col-md-12 mt-3 justify-content-between ">
                <div class="d-flex col-4">
                    <a href="{{route('pekerjaan.create')}}" class="btn btn-primary m-2">+ Tambah Data</a>
                </div>
                <div class="col-md-3 mt-1 mx-1">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari...">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" style="margin-top: -10px;">
                <thead>
                    <tr class="text-center">
                    <th  style="width: 50px">No</th>
                    <th>@sortablelink('jenis_pekerjaan', 'Jenis Pekerjaan')</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pekerjaans as $index => $pekerjaan)
                    <tr class="text-center">
                        <input type="hidden" class="delete_id" value="{{$pekerjaan->id}}">
                        <td>{{$index + $pekerjaans->firstItem()}}</td>
                        <td>{{$pekerjaan->jenis_pekerjaan}}</td>
                        <td>
                        <div class="dropdown">
                            <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{route('pekerjaan.edit', $pekerjaan->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-edit"></i> Edit</a>
                                
                                <form action="{{route('pekerjaan.destroy', $pekerjaan->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger dropdown-item  confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>


                        </td>
                    @empty
                    <td colspan="9" class="text-center">Data Pekerjaan Belum Ada !</td>
                    @endforelse
                    </tr>
                </tbody>
                </table>
            </div>
            <!-- Pagination Link -->
            <div class="d-flex justify-content-end mx-5">
                {!! $pekerjaans->appends(\Request::except('page'))->render() !!}
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

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.confirm-delete').click(function (e) {
            e.preventDefault();

            var deletedid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan data ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deletedid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'pekerjaan/' + deletedid,
                            data: data,
                            success: function (response) {
                                swal(response.status, {
                                    icon: "success",
                                })
                                .then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
        })
    })
</script>
@endpush

