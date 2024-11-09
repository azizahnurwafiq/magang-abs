@extends('dashboard.template')
@section('title', 'Tambah data pelanggan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Add stok lama</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form id="stokLamaForm" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategori" class="form-label d-block">kategori</label>
                                <select class="form-control" aria-label="Default select example" name="kategori" id="kategori">
                                <option selected>Pilih kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value={{$kategori->id}}>{{$kategori->kategori}}</option>    
                                @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="item" class="form-label d-block">item</label>
                                <select class="form-control" aria-label="Default select example" name="item" id="item">
                                <option selected>Pilih item</option>
                                @foreach ($datas as $data)
                                    <option value={{$data->item}}>{{$data->item}}</option>    
                                @endforeach
                                </select>
                            </div>
            
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" min="0 name="jumlah" id="jumlah" value="{{ @old('jumlah')}}" aria-describedby="emailHelp">
                                    {{-- @error('jumlah')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror --}}
                                </div>
                            </div>
        
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="tanggal_masuk_baru" class="form-label">Tanggal masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk_baru" id="tanggal_masuk_baru" value="{{ @old('tanggal_masuk_baru')}}" aria-describedby="emailHelp">
                                    {{-- @error('tanggal_masuk_baru')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror --}}
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