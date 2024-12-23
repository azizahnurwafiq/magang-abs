@extends('dashboard.template')
@section('title', 'Tambah data pelanggan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Add stok lama</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form action="{{route('admin.stok_barang.addStokLama')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="SKU" class="form-label d-block">Item</label>
                                <select class="form-control form-select" aria-label="Default select example" name="SKU" id="SKU">
                                <option selected>--Pilih berdasarkan item--</option>
                                @foreach ($stoks as $stok)
                                    <option value={{$stok->id}}>{{$stok->item}}</option>    
                                @endforeach
                                </select>
                            </div>
            
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah Stok</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" aria-describedby="emailHelp">
                                    @error('jumlah')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="tanggal_masuk_baru" class="form-label">Tanggal masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk_baru" id="tanggal_masuk_baru" aria-describedby="emailHelp">
                                    @error('tanggal_masuk_baru')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary ml-3 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection