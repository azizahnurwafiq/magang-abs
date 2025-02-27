@extends('dashboard.template')
@section('title', 'Tambah data item baru')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Add item baru</h3>
            <div class="card ml-2 mt-4">
                @if (request()->is('admin*'))
                <form action="{{route('admin.stok_barang.store')}}" method="POST">
                    @elseif (request()->is('manager*'))
                    <form action="{{route('manager.stok_barang.store')}}" method="POST">
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="d-flex col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="SKU">SKU</label>
                                        <input type="text" name="SKU" id="SKU" class="form-control" placeholder="SKU">
                                        @error('SKU')
                                            <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-control form-select" name="kategori" id="kategori">
                                            <option selected>--Pilih kategori--</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value={{$kategori->id}}>{{$kategori->kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="item">Item</label>
                                        <input type="text" name="item" id="item" class="form-control" placeholder="item">
                                        @error('item')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" min="0" class="form-control" placeholder="jumlah">
                                        @error('jumlah')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" placeholder="tanggal masuk">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli</label>
                                        <input type="number" name="harga_beli" id="harga_beli" min="0" class="form-control" placeholder="harga beli">
                                        @error('harga_beli')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual</label>
                                        <input type="number" name="harga_jual" id="harga_jual" min="0" class="form-control" placeholder="harga jual">
                                        @error('harga_jual')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mx-3 my-3">Submit</button>
                        </div>
                    </form>
            </div>
            @if (request()->is('admin*'))
                <a href="{{route('admin.stok_barang.barang')}}" class="btn btn-success m-2">Kembali</a>
            @elseif (request()->is('manager*'))
                <a href="{{route('manager.stok_barang.barang')}}" class="btn btn-success m-2">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection