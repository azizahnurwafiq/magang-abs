<div>
    @if(auth()->user()->role === 'admin')
    <div class="d-flex col-md-3 mx-2" style="justify-self:right; margin-top:-50px;">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." wire:model.live="keyword">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    @endif

    @if(auth()->user()->role === 'produksi')
    <div class="d-flex col-md-3 mx-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." wire:model.live="keyword">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    @endif

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>No Invoice</th>
                    <th style="width: 20%">Judul Article</th>
                    <th>Jenis Pekerjaan</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($details as $index => $detail)
                <tr class="text-center">
                    <input type="hidden" class="delete_id" value="{{$detail->id}}">
                    <td>{{ ($details->currentPage() - 1) * $details->perPage() + $loop->index + 1 }}</td>
                    <td>{{$detail->preOrder->nama_pelanggan ?? '-'}}</td>
                    <td>{{$detail->preOrder->invoice->no_invoice ?? '-'}}</td>
                    <td>{{$detail->preOrder->judul_artikel ?? '-'}}</td>
                    <td>
                        {{$detail->pekerjaan->jenis_pekerjaan ?? '-'}}
                    </td>
                    <td>
                        @if ($detail->status)
                        @php
                            $statusClass = match ($detail->status) {
                                'BUTUH DIKERJAKAN' => 'bg-warning',
                                'HOLD' => 'bg-danger',
                                'WIP' => 'bg-secondary',
                                'DIAMBIL' => 'bg-primary',
                                'DONE AND READY' => 'bg-success',
                                'REVISI' => 'bg-info',
                                'BATAL' => 'bg-dark',
                            };
                        @endphp

                        <span class="badge {{$statusClass}} status-label" data-id="{{$detail->id}}" data-status="{{$detail->status}}" onclick="toggleStatusDropdown($(this))">{{$detail->status}}</span>

                        {{-- Dropdown status --}}
                        <select class="form-control status-dropdown d-none" data-id="{{ $detail->id }}"
                            onchange="updateStatus($(this))">
                            <option class="bg-warning" value="BUTUH DIKERJAKAN" {{ $detail->status == 'BUTUH DIKERJAKAN' ? 'selected' : '' }}>BUTUH DIKERJAKAN</option>
                            <option class="bg-danger" value="HOLD" {{ $detail->status == 'HOLD' ? 'selected' : '' }}>HOLD</option>
                            <option class="bg-secondary" value="WIP" {{ $detail->status == 'WIP' ? 'selected' : '' }}>WIP</option>
                            <option class="bg-primary" value="DIAMBIL" {{ $detail->status == 'DIAMBIL' ? 'selected' : '' }}>DIAMBIL</option>
                            <option class="bg-success" value="DONE AND READY" {{ $detail->status == 'DONE AND READY' ? 'selected' : '' }}>DONE AND READY</option>
                            <option class="bg-info" value="REVISI" {{ $detail->status == 'REVISI' ? 'selected' : '' }}>REVISI</option>
                            <option class="bg-dark" value="BATAL" {{ $detail->status == 'BATAL' ? 'selected' : '' }}>BATAL</option>
                        </select>
                        @endif
                    </td>
                    <td>
                        @php
                            // Ambil tanggal deadline sebagai objek Carbon
                            $deadlineDate = \Carbon\Carbon::parse($detail->deadline);
                            // Hitung jumlah hari tersisa dari hari ini (dengan nilai negatif jika sudah lewat)
                            $daysLeft = $deadlineDate->diffInDays(\Carbon\Carbon::today());
                            // Cek apakah deadline sudah lewat
                            $isPast = $deadlineDate->isPast() && !$deadlineDate->isToday();
                        @endphp

                        @if ($isPast)
                        <span style="background-color: black; color: red; padding: 5px; border-radius: 5px;">
                            Melewati Deadline
                        </span>
                        @elseif ($daysLeft === 0)
                        <span style="background-color: red; color: white; padding: 5px; border-radius: 5px;">
                            Hari ini
                        </span>
                        @elseif ($daysLeft >= 1 && $daysLeft <= 2)
                            <span style="background-color: red; color: white; padding: 5px; border-radius: 5px;">
                            {{ $daysLeft }} Hari lagi
                            </span>
                            @elseif ($daysLeft >= 3 && $daysLeft <= 5)
                                <span style="background-color: yellow; color: black; padding: 5px; border-radius: 5px;">
                                {{ $daysLeft }} Hari lagi
                                </span>
                                @else
                                <span style="background-color: rgb(25, 202, 37); color: white; padding: 5px; border-radius: 5px;">
                                    {{ $daysLeft }} Hari lagi
                                </span>
                                @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                {{-- <a href="#" class="btn btn-primary dropdown-item "><i class="fa fa-edit"></i> Edit</a> --}}
                                @if (auth()->user()->role === 'manager')
                                <a href="{{route('manager.preOrder.show', $detail->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Details</a>

                                <a href="#" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>

                                <form action="{{route('manager.preOrder.destroy', $detail->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger dropdown-item confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                                </form>

                                <form action="{{route('manager.preOrder.archive', $detail->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-success dropdown-item"><i class="fa fa-file"></i> Archive</button>
                                </form>
                                @endif

                                @if (auth()->user()->role === 'admin')
                                <a href="{{route('admin.preOrder.show', $detail->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Details</a>

                                <a href="#" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>

                                <form action="{{route('admin.preOrder.destroy', $detail->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger dropdown-item confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                                </form>

                                <form action="{{route('admin.preOrder.archive', $detail->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-success dropdown-item"><i class="fa fa-file"></i> Archive</button>
                                </form>
                                @endif

                                @if (auth()->user()->role === 'produksi')
                                <a href="{{route('produksi.preOrder.show', $detail->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Details</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Data PO Belum Ada !</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination Link -->
    <div class="d-flex justify-content-end mx-5">
        {{ $details->links() }}
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
        margin-left: -40px;
        min-width: 110px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
    // memperbarui status
    $(document).ready(function() {
        // Fungsi untuk menampilkan dropdown status saat label diklik
        window.toggleStatusDropdown = function(labelElement) {
            let statusLabel = labelElement; // Elemen label
            let statusDropdown = statusLabel.next('.status-dropdown'); // Dropdown di sebelahnya

            // Sembunyikan label dan tampilkan dropdown
            statusLabel.addClass('d-none');
            statusDropdown.removeClass('d-none');
        };

        window.updateStatus = function(dropdownElement) {
            let dropdown = dropdownElement;
            let statusLabel = dropdown.prev('.status-label');
            let newStatus = dropdown.val();
            let preOrderId = dropdown.data('id');

            // Perbarui teks pada label
            statusLabel.text(newStatus);
            statusLabel.data('status', newStatus);

            // perbarui warna background berdasarkan status baru
            let newClass = '';
            switch (newStatus) {
                case 'BUTUH DIKERJAKAN':
                    newClass = 'bg-warning';
                    break;
                case 'DONE AND READY':
                    newClass = 'bg-success';
                    break;
                case 'HOLD':
                    newClass = 'bg-danger';
                    break;
                case 'REVISI':
                    newClass = 'bg-info';
                    break;
                case 'DIAMBIL':
                    newClass = 'bg-primary';
                    break;
                case 'WIP':
                    newClass = 'bg-secondary';
                    break;
                case 'BATAL':
                    newClass = 'bg-dark';
                    break;
                default:
                    newClass = 'bg-secondary';
                    break;
            }

            // Hapus semua kelas warna sebelumnya dari label dan tambahkan kelas baru
            statusLabel
                .removeClass('bg-warning bg-dark bg-success bg-info bg-danger bg-primary bg-secondary')
                .addClass(newClass);

            // Sembunyikan dropdown dan tampilkan label
            dropdown.addClass('d-none');
            statusLabel.removeClass('d-none');

            // kirim data ke server dengan AJAX
            $.ajax({
                url: `/admin/pre-order/${preOrderId}/update-status`,
                method: 'POST',
                data: {
                    status: newStatus,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    swal({
                        title: "Berhasil",
                        text: "Berhasil memperbarui status",
                        icon: "success",
                        showConfirmButton: true,
                        timer: 2000
                    });
                },
                error: function(xhr) {
                    swal({
                        title: "Gagal!",
                        text: "Gagal memperbarui status",
                        icon: "error",
                        showConfirmButton: true,
                        timer: 2000
                    })
                }
            });
        };
    });

    //Menghapus data
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
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deletedid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: '/admin/pre-order/' + deletedid,
                            data: data,
                            success: function(response) {
                                swal({
                                    title: "Berhasil",
                                    icon: "success",
                                    text: response.status,
                                    showConfirmButton: true,
                                    timer: 2000
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        swal("Data pre-order tidak jadi dihapus");
                    }
                });
        })
    })
</script>
@endpush