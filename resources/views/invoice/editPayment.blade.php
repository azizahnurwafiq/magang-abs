@extends('dashboard.template')
@section('title', 'Edit payment')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Edit payment</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    @if (request()->is('admin*'))
                    <form action="{{route('admin.invoice.history.update', ['id' => $payment->id]) }}" method="POST">
                        @elseif (request()->is('manager*'))
                        <form action="{{route('manager.invoice.history.update', ['id' => $payment->id]) }}" method="POST">
                            @endif
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="payment" class="form-label">Payment</label>
                                <input type="number" class="form-control" name="payment" id="payment" value="{{$payment->payment}}" aria-describedby="emailHelp">
                                @error('payment')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{$payment->tanggal}}" aria-describedby="emailHelp">
                                @error('tanggal')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="via" class="form-label">Via</label>
                                <select class="form-control form-select item-select" name="via" value="{{$payment->via}}" id="via">
                                    <option selected>--Pilih Metode Pembayaran--</option>
                                    <option>Transfer</option>
                                    <option>Cash</option>
                                </select>
                                @error('via')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection