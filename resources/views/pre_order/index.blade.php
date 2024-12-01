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
                </div>
                @livewire('pre-order-search')
            </div>
        </div>
</div>
@endsection
