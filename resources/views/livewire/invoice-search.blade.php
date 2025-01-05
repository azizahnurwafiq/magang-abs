<div>
    <div class="d-flex col-md-3 mx-2" style="justify-self:right; margin-top:-50px;">
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
                @forelse ($invoices as $index => $invoice)
                <tr class="text-center">
                    <td>{{$index + $invoices->firstItem()}}</td>
                    <td>{{$invoice->kode}}</td>
                    <td>{{$invoice->no_invoice}}</td>
                    <td>{{$invoice?->pelanggan->nama ?? 'pelanggan tidak tersedia'}}</td>
                    <td>@rupiah($invoice->total_invoice)</td>
                    <td>@rupiah($invoice->kekurangan_bayar)</td>
                    <td>
                        @if($invoice->status === "BELUM LUNAS")
                        <span class="badge bg-danger">Belum lunas</span>
                        @endif
                        @if ($invoice->status === "LUNAS")
                        <span class="badge bg-success">Lunas</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if (request()->is('admin*'))
                                <a href="{{route('admin.invoice.show', $invoice->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Detail</a>
                                <a href="{{route('admin.invoice.payment', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-money-bill-wave"></i> Payment</a>
                                <a href="{{route('admin.invoice.history', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-history"></i> History</a>
                                <a href="{{route('admin.invoice.exportPdf', $invoice->id)}}" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>
                                <form action="{{route('admin.invoice.archive', $invoice->id)}}" method="POST">
                                    @elseif (request()->is('manager*'))
                                    <a href="{{route('manager.invoice.show', $invoice->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Detail</a>
                                    <a href="{{route('manager.invoice.payment', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-money-bill-wave"></i> Payment</a>
                                    <a href="{{route('manager.invoice.history', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-history"></i> History</a>
                                    <a href="{{route('manager.invoice.exportPdf', $invoice->id)}}" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>
                                    <form action="{{route('manager.invoice.archive', $invoice->id)}}" method="POST">
                                        @endif

                                        @csrf
                                        <button class="btn btn-success dropdown-item"><i class="fa fa-file"></i> Archive</button>
                                    </form>
                            </div>
                        </div>
                    </td>
                    @empty
                    <td colspan="9" class="text-center">Data Invoice Belum Ada !</td>
                    @endforelse
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Pagination Link -->
    <div class="d-flex justify-content-end mx-5">
        {!! $invoices->appends(\Request::except('page'))->render() !!}
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
</style>
@endpush