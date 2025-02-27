@extends('dashboard.template')
@section('title', 'Invoice')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold text-primary">ARSIP INVOICE</h3>
                </div>
                @livewire('arsip-search')
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
</script>
@endpush