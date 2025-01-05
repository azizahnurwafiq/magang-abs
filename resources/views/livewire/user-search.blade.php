<div>
    <div class="d-flex col-md-3 mx-3" style="justify-self:right; margin-top:-50px;">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." wire:model.live="kataKunci">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th style="width: 50px">No</th>
                    <th>Nama Pengguna</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr class="text-center">
                    <input type="hidden" class="delete_id" value="{{$user->id}}">
                    <td>{{$index + $users->firstItem()}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{route('manager.manage_user.edit', $user->id)}}" class="btn btn-primary dropdown-item "><i class="fa fa-edit"></i> Edit</a>

                                <form action="{{route('manager.manage_user.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger dropdown-item  confirm-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    @empty
                    <td colspan="9" class="text-center">Data user Belum Ada !</td>
                    @endforelse
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mx-5">
        {{ $users->links() }}
    </div>
</div>