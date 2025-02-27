@extends('dashboard.template')
@section('title', 'Tambah data kategori')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Tambah jenis pekerjaan</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    @if (request()->is('admin*'))
                    <form action="{{route('admin.pekerjaan.store')}}" method="POST">
                        @elseif (request()->is('manager*'))
                        <form action="{{route('manager.pekerjaan.store')}}" method="POST">
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan</label>
                                <input type="text" class="form-control" name="jenis_pekerjaan" id="jenis_pekerjaan" aria-describedby="emailHelp">
                                @error('jenis_pekerjaan')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
            @if (request()->is('admin*'))
                <a href="{{route('admin.pekerjaan.index')}}" class="btn btn-success m-2">Kembali</a>
            @elseif (request()->is('manager*'))
                <a href="{{route('manager.pekerjaan.index')}}" class="btn btn-success m-2">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection