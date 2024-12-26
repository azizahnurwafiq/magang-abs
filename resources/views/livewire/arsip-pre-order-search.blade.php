<div>
    <div class="d-flex col-md-3 mx-3 mt-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." wire:model.live="keyword">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>

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
                @forelse ($detailArsips as $index => $detail)
                    <tr class="text-center">
                        <input type="hidden" class="delete_id" value="{{$detail->id}}">
                        <td>1</td>
                        <td>{{$detail->preOrder->nama_pelanggan ?? '-'}}</td>
                        <td>{{$detail->preOrder->invoice->no_invoice ?? '-'}}</td>
                        <td>{{$detail->preOrder->judul_artikel ?? '-'}}</td>
                        <td>
                            {{$detail->pekerjaan->jenis_pekerjaan ?? '-'}}
                        </td>
                        <td>
                            @if($detail->status === "BUTUH DIKERJAKAN")
                                <span class="badge bg-warning">BUTUH DIKERJAKAN</span>
                            @endif
                            @if($detail->status === "HOLD")
                                <span class="badge bg-danger">HOLD</span>
                            @endif
                            @if($detail->status === "WIP")
                                <span class="badge bg-secondary">WIP</span>
                            @endif
                            @if($detail->status === "DIAMBIL")
                                <span class="badge bg-primary">DIAMBIL</span>
                            @endif
                            @if($detail->status === "DONE AND READY")
                                <span class="badge bg-success">DONE AND READY</span>
                            @endif
                            @if($detail->status === "REVISI")
                                <span class="badge bg-info">REVISI</span>
                            @endif
                            @if($detail->status === "BATAL")
                                <span class="badge bg-dark">BATAL</span>
                            @endif
                        </td>
                        <td>
                            @php
                                // Ambil tanggal deadline sebagai objek Carbon
                                $deadlineDate = \Carbon\Carbon::parse($detail->deadline);
                                // Hitung jumlah hari tersisa dari hari ini (dengan nilai negatif jika sudah lewat)
                                $daysLeft = $deadlineDate->diffInDays(\Carbon\Carbon::today());
                                // Cek apakah deadline sudah lewat
                                $isPast = $deadlineDate->isPast() && !$deadlineDate->isToday(); // Lewat tetapi bukan hari ini
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
                            <form action="{{route('admin.preOrderArchive.restore', $detail->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-success mx-1"><i class="fa fa-undo"> </i>  Pulihkan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Arsip PO Belum Ada !</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination Link -->
    <div class="d-flex justify-content-end mx-5">
        {{ $detailArsips->links() }}
    </div>
</div>

