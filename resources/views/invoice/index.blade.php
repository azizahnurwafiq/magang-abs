@extends('dashboard.template')
@section('title', 'Invoice')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold text-primary">DATA INVOICE</h3>
                </div>
                <div class=" d-flex col-md-12 mt-3 justify-content-between ">
                    <div class="col-md-8">
                        @if (request()->is('admin*'))
                            <a href="{{route('admin.invoice.create')}}" class="btn btn-primary m-2">+ Buat Invoice</a>
                        @elseif (request()->is('manager*'))
                            <a href="{{route('manager.invoice.create')}}" class="btn btn-primary m-2">+ Buat Invoice</a>
                        @endif
                    </div>
                </div>
                @livewire('invoice-search')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if (session('success'))
        swal({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    @if (session('error'))
        swal({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            showConfirmButton: true,
        });
    @endif
</script>
@endpush