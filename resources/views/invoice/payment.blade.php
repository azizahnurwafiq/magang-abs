@extends('dashboard.template')
@section('title', 'Payment')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div>
            <h3 class="ml-2">Payment</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    @if (request()->is('admin*'))
                    <form action="{{route('admin.invoice.payment.store', ['id' => $invoice->id])}}" method="POST">
                    @elseif (request()->is('manager*'))
                    <form action="{{route('manager.invoice.payment.store', ['id' => $invoice->id])}}" method="POST">
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment</label>
                            <input type="number" class="form-control" min="0" name="payment" id="payment" aria-describedby="emailHelp">
                            @error('payment')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" aria-describedby="emailHelp">
                            @error('tanggal')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="via" class="form-label">Via</label>
                            <select class="form-control form-select item-select" name="via" id="via">
                                <option selected>--Pilih Metode Pembayaran--</option>
                                <option>Transfer</option>
                                <option>Cash</option>
                            </select>
                            @error('via')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
            @if (request()->is('admin*'))
                <a href="{{route('admin.invoice.index')}}" class="btn btn-success m-2">Kembali</a>
            @elseif (request()->is('manager*'))
                <a href="{{route('manager.invoice.index')}}" class="btn btn-success m-2">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection