@extends('dashboard.template')
@section('title', 'History payment')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">History Payment</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Payment</th>
                                <th>Tanggal</th>
                                <th>Via</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                            <tr class="text-center">  
                                <input type="hidden" class="delete_id" value="{{$payment->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>@rupiah($payment->payment)</td>
                                <td>{{$payment->tanggal}}</td>
                                <td>{{$payment->via}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                                        </button>
                                            <div class="dropdown-menu">
                                                <a href="{{route('admin.invoice.history.edit', $payment->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-edit"></i> Edit</a>

                                                <form action="{{route('admin.invoice.history.destroy', $payment->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger dropdown-item confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                    </div>
                                </td>
                            @empty
                                <td colspan="8" class="text-center">History payment Belum Ada!<td>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Link -->
                {{-- <div class="d-flex justify-content-end mx-5">
                    {{ $invoices->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

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
                            url: '/invoice/history-payment/' + deletedid,
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