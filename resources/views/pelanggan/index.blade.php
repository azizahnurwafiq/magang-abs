@extends('dashboard.template')
@section('title', 'Pelanggan')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold text-primary">DATA PELANGGAN</h3>
                </div>
                <div class="row align-items-center my-1">
                    <div class="col-md-8">
                        @if (request()->is('admin*'))
                        <a href="{{route('admin.pelanggan.create')}}" class="btn btn-primary mx-3 my-4">+ Tambah Data</a>
                        @elseif (request()->is('manager*'))
                        <a href="{{route('manager.pelanggan.create')}}" class="btn btn-primary mx-3 my-4">+ Tambah Data</a>
                        @endif
                    </div>
                </div>
                @livewire('pelanggan-search')
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .note {
        max-width: 200px;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    @if (session('success'))
        swal({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: true,
            timer: 2000
        });
    @endif
</script>
@endpush