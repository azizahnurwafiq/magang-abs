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

                @if (session('success'))
                    <div class="alert alert-success" role="alert" style="margin: 20px 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row align-items-center my-1">
                    <div class="col-md-8">
                        <a href="{{route('pelanggan.create')}}" class="btn btn-primary mx-3 my-4">+ Tambah Data</a>
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
        .note{
            max-width: 200px;
        }
    </style>
@endpush