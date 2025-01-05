<div>
    <div class="d-flex col-md-3 mx-3 mt-3">
        <div class="input-group">
            <input type="text" class="form-control" wire:model.live="keyword" placeholder="Cari...">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>


    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>@sortablelink('kode', 'Kode')</th>
                    <th>@sortablelink('no_invoice', 'No Invoice')</th>
                    <th>@sortablelink('pelanggan.nama', 'Nama')</th>
                    <th>@sortablelink('total_invoice', 'Total Invoice')</th>
                    <th>@sortablelink('kekurangan_bayar', 'Kekurangan Bayar')</th>
                    <th>@sortablelink('status', 'Status')</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($arsips as $index => $arsip)
                <tr class="text-center">
                    <input type="hidden" class="delete_id" value="{{$arsip->id}}">
                    <td>{{$index + $arsips->firstItem()}}</td>
                    <td>{{$arsip->kode}}</td>
                    <td>{{$arsip->no_invoice}}</td>
                    <td>{{$arsip?->pelanggan->nama ?? 'pelanggan tidak tersedia'}}</td>
                    <td>@rupiah($arsip->total_invoice)</td>
                    <td>@rupiah($arsip->kekurangan_bayar)</td>
                    <td>
                        @if($arsip->status === "BELUM LUNAS")
                        <span class="badge bg-danger">Belum lunas</span>
                        @endif
                        @if($arsip->status === "LUNAS")
                        <span class="badge bg-success">lunas</span>
                        @endif
                    </td>
                    <td class="d-flex">
                        @if (request()->is('admin*'))
                        <form action="{{route('admin.archive.restore', $arsip->id)}}" method="POST">
                            @elseif (request()->is('manager*'))
                            <form action="{{route('manager.archive.restore', $arsip->id)}}" method="POST">
                                @endif
                                @csrf
                                <button class="btn btn-success mx-1"><i class="fa fa-undo"> </i> Pulihkan</button>
                            </form>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                            </form>

                            {{-- <div class="dropdown">
                            <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                            </button>
                                <div class="dropdown-menu">    
                            <a href="{{route('invoice.payment', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-money-bill-wave"></i> Payment</a>
                            <a href="{{route('invoice.history', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-history"></i> History</a>
                            <a href="{{route('invoice.exportPdf', $invoice->id)}}" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>

                            <form action="{{route('invoice.archive', $invoice->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-success dropdown-item"><i class="fa fa-file"></i> Archive</button>
                            </form>
    </div>
</div> --}}
</td>
@empty
<td colspan="9" class="text-center">Arsip Belum Ada !</td>
@endforelse
</tr>
</tbody>
</table>
</div>
<!-- Pagination Link -->
<div class="d-flex justify-content-end mx-5">
    {!! $arsips->appends(\Request::except('page'))->render() !!}
</div>
</div>