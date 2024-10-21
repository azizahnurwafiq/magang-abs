<div>
    <div class="col-md-3 mx-2">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari..." wire:model.live="kataKunci">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor WA</th>
                <th>Alamat</th>
                <th>Note</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggans as $index => $pelanggan)
                    <tr class="text-center">
                        <td>{{$index + $pelanggans->firstItem()}}</td>
                        <td>{{$pelanggan->nama}}</td>
                        <td>{{$pelanggan->email}}</td>
                        <td>{{$pelanggan->no_WA}}</td>
                        <td>{{$pelanggan->alamat}}</td>
                        <td class="note">{{$pelanggan->note}}</td>
                        <td>
                            <a href="{{route('pelanggan.edit', $pelanggan->id)}}" class="btn btn-primary m-2"><i class="fa fa-edit"></i> Edit</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Hapus</button>
            
                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data ini ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            
                                            <!-- Form Hapus -->
                                            <form action="{{route('pelanggan.destroy', $pelanggan->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Data Pelanggan Belum Ada !</td>
                    </tr>
                @endforelse         
            </tbody>
        </table>           
    </div>
</div>