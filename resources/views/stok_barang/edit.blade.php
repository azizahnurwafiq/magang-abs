@extends('dashboard.template')
@section('title', 'Edit data stok barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Edit data stok barang</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    @if (request()->is('admin*'))
                    <form action="{{route('admin.stok_barang.update', $stok->id)}}" method="POST">
                        @elseif (request()->is('manager*'))
                        <form action="{{route('manager.stok_barang.update', $stok->id)}}" method="POST">
                            @endif
                            @csrf
                            @method('PUT')
                            <div class="d-flex col-md-12">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="SKU" id="SKU" value="{{$stok->SKU}}" aria-describedby="emailHelp">
                                        @error('SKU')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control form-select" name="kategori" id="kategori">
                                            <option selected>--Pilih Kategori--</option>
                                            @foreach ($kategoris as $kt)
                                            <option value="{{$kt->id}}">{{$kt->kategori}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" name="kategori" id="kategori" value="{{$stok->kategori->kategori}}" aria-describedby="emailHelp">
                                        @error('email')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item</label>
                                        <input type="text" class="form-control" name="item" id="item" value="{{$stok->item}}" aria-describedby="emailHelp">
                                        @error('no_WA')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Harga Beli</label>
                                        <input type="text" class="form-control" name="harga_beli" id="harga_beli" value="{{$stok->harga_beli}}" aria-describedby="emailHelp">
                                        @error('note')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Harga Jual</label>
                                        <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="{{$stok->harga_jual}}" aria-describedby="emailHelp">
                                        @error('note')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-3">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection