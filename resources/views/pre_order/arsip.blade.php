@extends('dashboard.template')
@section('title', 'Pre Order')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold text-primary">DATA PRE ORDER</h3>
                </div>
                @livewire('arsip-pre-order-search')
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
            margin-left: -40px;
            min-width: 110px; 
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

        .d-none {
            display: none;
        }

        .status-label {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        @if (session('success'))
            swal({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @endif
        // memperbarui status
        // $(document).ready(function() {
        //     // Fungsi untuk menampilkan dropdown status saat label diklik
        //     window.toggleStatusDropdown = function (labelElement) {
        //         let statusLabel = labelElement; // Elemen label
        //         let statusDropdown = statusLabel.next('.status-dropdown'); // Dropdown di sebelahnya

        //         // Sembunyikan label dan tampilkan dropdown
        //         statusLabel.addClass('d-none');
        //         statusDropdown.removeClass('d-none');
        //     };

        //     window.updateStatus = function (dropdownElement){
        //         let dropdown = dropdownElement;
        //         let statusLabel = dropdown.prev('.status-label');
        //         let newStatus = dropdown.val();
        //         let preOrderId = dropdown.data('id');

        //         // Perbarui teks pada label
        //         statusLabel.text(newStatus);
        //         statusLabel.data('status', newStatus);

        //         // perbarui warna background berdasarkan status baru
        //         let newClass = '';
        //         switch (newStatus) {
        //             case 'BUTUH DIKERJAKAN':
        //                 newClass = 'bg-warning';
        //                 break;
        //             case 'DONE AND READY':
        //                 newClass = 'bg-success';
        //                 break;
        //             case 'HOLD':
        //                 newClass = 'bg-danger';
        //                 break;
        //             case 'REVISI':
        //                 newClass = 'bg-info';
        //                 break;
        //             case 'DIAMBIL':
        //                 newClass = 'bg-primary';
        //                 break;
        //             case 'WIP':
        //                 newClass = 'bg-secondary';
        //                 break;
        //             case 'BATAL':
        //                 newClass = 'bg-dark';
        //                 break;
        //             default:
        //                 newClass = 'bg-secondary';
        //                 break;
        //         }

        //          // Hapus semua kelas warna sebelumnya dari label dan tambahkan kelas baru
        //         statusLabel
        //         .removeClass('bg-warning bg-dark bg-success bg-info bg-danger bg-primary bg-secondary')
        //         .addClass(newClass);

        //          // Sembunyikan dropdown dan tampilkan label
        //         dropdown.addClass('d-none');
        //         statusLabel.removeClass('d-none');

        //         // kirim data ke server dengan AJAX
        //         $.ajax({
        //             url: `/pre-order/${preOrderId}/update-status`,
        //             method: 'POST',
        //             data: {
        //                 status: newStatus,
        //                 _token: $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(response) {
        //                 alert('status berhasil diperbarui');
        //                 console.log(response);
        //             },
        //             error: function (xhr) {
        //                 alert('Gagal memperbarui status');
        //                 console.log(xhr);
        //             }
        //         });
        //     };
        // });

        //Menghapus data
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
                                url: '/pre-order/' + deletedid,
                                data: data,
                                success: function (response) {
                                    swal({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.status,
                                        showConfirmButton: true,
                                        timer: 2000
                                    }).then((result) => {
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