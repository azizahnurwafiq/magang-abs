@extends('dashboard.template')
@section('title', 'Detail stok barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Detail Invoice</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="kategori" class="form-label">Kode</label>
                                <p>
                                    {{$invoice->kode}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">No Invoice</label>
                                <p>
                                    {{$invoice->no_invoice}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Nama</label>
                                <p>
                                    {{$invoice->pelanggan->nama}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Alamat</label>
                                <p>
                                    {{$invoice->alamat}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Tanggal</label>
                                <p>
                                    {{$invoice->tanggal}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Judul</label>
                                <p>
                                    {{$invoice->judul}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">down payment</label>
                                <p>
                                    @rupiah($invoice->down_payment)
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Kekurangan bayar</label>
                                <p>
                                    @rupiah($invoice->kekurangan_bayar)
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Total invoice</label>
                                <p>
                                    @rupiah($invoice->total_invoice)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Status</label>
                                <p>
                                    {{$invoice->status}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('admin.invoice.index')}}" class="btn btn-primary m-2">Kembali</a>
        </div>
    </div>
</div>
@endsection