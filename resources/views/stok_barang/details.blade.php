@extends('dashboard.template')
@section('title', 'Detail stok barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Detail stok barang</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <div class="mb-3">
                        <label for="nama" class="form-label">SKU</label>
                        <p>
                            {{$stok->SKU}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Kategori</label>
                        <p>
                            {{$stok->kategori}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="no_WA" class="form-label">Item</label>
                        <p>
                            {{$stok->item}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Warna</label>
                        <p>
                            {{$stok->warna}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Jumlah</label>
                        <p>
                            {{$stok->jumlah}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Tanggal Masuk</label>
                        <p>
                            {{$stok->tanggal_masuk}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Harga beli</label>
                        <p>
                            {{$stok->harga_beli}}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Harga jual</label>
                        <p>
                            {{$stok->harga_jual}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection