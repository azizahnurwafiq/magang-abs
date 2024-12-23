@extends('dashboard.template')
@section('title', 'Edit jenis pekerjaan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Edit data pekerjaan</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form action="{{route('admin.pekerjaan.update', $pekerjaan->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan</label>
                            <input type="text" class="form-control" name="jenis_pekerjaan" id="jenis_pekerjaan" value="{{$pekerjaan->jenis_pekerjaan}}" aria-describedby="emailHelp">
                            @error('jenis_pekerjaan')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection