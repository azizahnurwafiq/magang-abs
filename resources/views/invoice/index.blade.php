@extends('dashboard.template')
@section('title', 'Invoice')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoice</h3>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-2">
                    <a href="{{route('invoice.create')}}" class="btn btn-primary m-2">+ Buat Invoice</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode</th>
                            <th>No Invoice</th>
                            <th>Nama</th>
                            <th>Total Invoice</th>
                            <th>Kekurangan Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $index => $invoice)
                        <tr class="text-center">
                            <td>{{$index + $invoices->firstItem()}}</td>
                            <td>{{$invoice->kode}}</td>
                            <td>{{$invoice->no_invoice}}</td>
                            <td>{{$invoice->pelanggan->nama}}</td>
                            <td>{{$invoice->total_invoice}}</td>
                            <td></td>
                            <td>{{$invoice->status}}</td>
                            <td>
                                <button class="btn btn-success">Lunas</button>
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
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection