<div>
    <div class="col-md-3 mx-2">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." wire:model.live="kataKunci">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                <th>No</th>
                <th style="width: 50px">Nama</th>
                <th style="width: 50px">Email</th>
                <th>Nomor WA</th>
                <th>Alamat</th>
                <th>Note</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggans as $index => $pelanggan)
                    <tr class="text-center">
                        <input type="hidden" class="delete_id" value="{{$pelanggan->id}}">
                        <td>{{$index + $pelanggans->firstItem()}}</td>
                        <td>{{$pelanggan->nama}}</td>
                        <td>{{$pelanggan->email}}</td>
                        <td>{{$pelanggan->no_WA}}</td>
                        <td>{{$pelanggan->alamat}}</td>
                        <td class="note">{{$pelanggan->note}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('pelanggan.edit', $pelanggan->id)}}" class="btn btn-primary dropdown-item m-2"><i class="fa fa-edit"></i> Edit</a>
        
                                    <form action="{{route('pelanggan.destroy', $pelanggan->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger dropdown-item confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Data Pelanggan Belum Ada !</td>
                    </tr>
                @endforelse         
            </tbody>
        </table>           
    </div>
    <!-- Pagination Link -->
    <div class="d-flex justify-content-end mx-5">
        {{$pelanggans->links()}}
    </div>
</div>

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
                            url: 'pelanggan/' + deletedid,
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
