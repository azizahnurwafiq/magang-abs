@extends('dashboard.template')
@section('title', 'Tambah data pelanggan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Tambah data pelanggan</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form action="{{route('admin.pelanggan.store')}}" method="POST">
                        @csrf
                        <div class="d-flex col-md-12">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ @old('nama')}}" aria-describedby="emailHelp">
                                    @error('nama')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ @old('email')}}" aria-describedby="emailHelp">
                                    @error('email')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_WA" class="form-label">Nomor WA</label>
                                    <input type="number" class="form-control" name="no_WA" id="no_WA" value="{{ @old('no_WA')}}"aria-describedby="emailHelp">
                                    @error('no_WA')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="{{ @old('alamat')}}" aria-describedby="emailHelp">
                                    @error('alamat')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <input type="text" class="form-control" name="note" id="note" value="{{ @old('note')}}" aria-describedby="emailHelp">
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