@extends('dashboard.template')
@section('title', 'Tambah data kategori')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Tambah User</h3>
            <div class="card ml-2 mt-3">
                <div class="m-4">
                    <form action="{{route('manager.manage_user.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" aria-describedby="emailHelp">
                            @error('username')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-describedby="emailHelp">
                            @error('password')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control form-select" name="role" id="role">
                                <option selected>--Pilih Role--</option>
                                <option value="admin">Admin</option>
                                <option value="produksi">Produksi</option>
                                <option value="manager">Manager</option>
                            </select>
                            @error('role')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            @if (request()->is('admin*'))
                <a href="{{route('admin.manage_user.user')}}" class="btn btn-success m-2">Kembali</a>
            @elseif (request()->is('manager*'))
                <a href="{{route('manager.manage_user.user')}}" class="btn btn-success m-2">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection