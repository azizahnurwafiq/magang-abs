@extends('dashboard.template')
@section('title', 'Edit data pelanggan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Edit data pelanggan</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    @if (request()->is('admin*'))
                    <form action="{{route('admin.pelanggan.update', $pelanggan->id)}}" method="POST">
                        @elseif (request()->is('manager*'))
                        <form action="{{route('manager.pelanggan.update', $pelanggan->id)}}" method="POST">
                            @endif
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{$pelanggan->nama}}" aria-describedby="emailHelp">
                                @error('nama')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$pelanggan->email}}" aria-describedby="emailHelp">
                                @error('email')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_WA" class="form-label">Nomor WA</label>
                                <input type="number" class="form-control" name="no_WA" id="no_WA" value="{{$pelanggan->no_WA}}" aria-describedby="emailHelp">
                                @error('no_WA')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{$pelanggan->alamat}}" aria-describedby="emailHelp">
                                @error('alamat')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <input type="text" class="form-control" name="note" id="note" value="{{$pelanggan->note}}" aria-describedby="emailHelp">
                                @error('note')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
            @if (request()->is('admin*'))
                <a href="{{route('admin.pelanggan.index')}}" class="btn btn-success m-2">Kembali</a>
            @elseif (request()->is('manager*'))
                <a href="{{route('manager.pelanggan.index')}}" class="btn btn-success m-2">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection