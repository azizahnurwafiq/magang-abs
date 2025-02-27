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
                <div class=" d-flex col-md-12 mt-3 justify-content-between ">
                    @if (request()->is('admin*'))
                    <div class="col-md-8">
                        <a href="{{route('admin.preOrder.create')}}" class="btn btn-primary m-2">+ Buat PO</a>
                    </div>
                    @elseif (request()->is('manager*'))
                    <div class="col-md-8">
                        <a href="{{route('manager.preOrder.create')}}" class="btn btn-primary m-2">+ Buat PO</a>
                    </div>
                    @endif
                </div>
                @livewire('pre-order-search')
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
                showConfirmButton: true,
                timer: 2000
            });
        @endif
    </script>
@endpush