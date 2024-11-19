@extends('dashboard.template')
@section('title', 'Pre Order')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold text-primary">DATA PRE ORDER</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class=" d-flex col-md-12 mt-3 justify-content-between ">
                    <div class="col-md-8">
                        <a href="{{route('preOrder.create')}}" class="btn btn-primary m-2">+ Buat PO</a>
                    </div>
                    <div class="col-md-3 mt-1 mx-1">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Cari...">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered table-striped" style="margin-top: -10px;">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Invoice</th>
                                <th>Judul Article</th>
                                <th>Jenis Pekerjaan</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse ($invoices as $index => $invoice) --}}
                            <tr class="text-center">
                                <td>1</td>
                                <td>ilham</td>
                                <td>INST/1125/001</td>
                                <td>Hello World</td>
                                <td>Sublim</td>
                                <td><span class="badge bg-success">Done and ready</span></td>
                                <td>2 hari lagi</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary" data-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i> <i class="fas fa-bars"></i>
                                        </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="btn btn-primary dropdown-item "><i class="fa fa-edit"></i> Edit</a>
                                                <a href="#" class="btn btn-secondary dropdown-item "><i class="fa fa-eye"></i> Details</a>
                                                <a href="#" class="btn btn-warning dropdown-item "><i class="fa fa-file-pdf"></i> Export PDF</a>
                                                <a href="#" class="btn btn-danger dropdown-item "><i class="fa fa-trash"></i> Hapus</a>
                                                <a href="#" class="btn btn-success dropdown-item "><i class="fa fa-file"></i> Archive</a>
                                            </div>
                                    </div>

                                </td>
                            {{-- @empty
                                <td colspan="9" class="text-center">Data Invoice Belum Ada !</td>
                            @endforelse --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Link -->
                {{-- <div class="d-flex justify-content-end mx-5">
                    {{ $invoices->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            margin-left: -40px;
            min-width: 110px; 
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 99;
            border-radius: 4px;
        }

        .dropdown-item {
            color: black;
            padding: 10px 20px;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #ddd;
        }
    </style>
@endpush