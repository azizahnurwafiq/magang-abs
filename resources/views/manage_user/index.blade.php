@extends('dashboard.template')
@section('title', 'Manage user')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">MANAGE USER</h3>
                </div>
                <div class=" d-flex col-md-12 mt-3 justify-content-between ">
                    <div class="d-flex col-2">
                        <a href="{{route('manager.manage_user.create')}}" class="btn btn-primary m-2">+ Tambah user</a>
                    </div>
                </div>
                @livewire('user-search')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if (session('success'))
        swal({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: true,
            timer: 1500
        });
    @endif

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.confirm-delete').click(function(e) {
            e.preventDefault();

            var deletedid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan data ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deletedid,
                        };

                        $.ajax({
                            type: "DELETE",
                            url: 'manage_user/' + deletedid,
                            data: data,
                            success: function(response) {
                                swal({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.status,
                                    showConfirmButton: true,
                                    timer: 2000
                                }).then((result) => {
                                        location.reload();
                                    });
                            },
                            error: function(response) {
                                swal({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.responseJSON.message, 
                                    showConfirmButton: true,
                                    timer: 2500
                                });
                            }
                        });
                    } else {
                        swal("Data user tidak jadi dihapus");
                    }
                });
        })
    })
</script>
@endpush