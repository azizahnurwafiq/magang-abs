@extends('dashboard.template')
@section('title', 'Edit jenis pekerjaan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Edit data user</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form action="{{route('manager.manage_user.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control form-select" name="role" id="role">
                                <option selected>--Pilih Role--</option>
                                <option value="admin">Admin</option>
                                <option value="produksi">Produksi</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection