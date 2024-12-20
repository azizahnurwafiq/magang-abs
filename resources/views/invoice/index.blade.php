@extends('dashboard.template')
@section('title', 'Invoice')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold text-primary">DATA INVOICE</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class=" d-flex col-md-12 mt-3 justify-content-between ">
                    <div class="col-md-8">
                        <a href="{{route('invoice.create')}}" class="btn btn-primary m-2">+ Buat Invoice</a>
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
                
                <div class="card-body">
                    <table class="table table-bordered table-striped" style="margin-top: -10px;">
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
                                                <a href="{{route('invoice.show', $invoice->id)}}" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Detail</a>
                                                <a href="{{route('invoice.payment', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-money-bill-wave"></i> Payment</a>
                                                <a href="{{route('invoice.history', $invoice->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-history"></i> History</a>
                                                <a href="{{route('invoice.exportPdf', $invoice->id)}}" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>
                                                <a href="#" class="btn btn-success dropdown-item "><i class="fa fa-file"></i> Archive</a>
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
    </style>
@endpush