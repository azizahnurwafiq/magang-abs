@extends('dashboard.template')
@section('title', 'Payment')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-6">
            <h3 class="ml-2">Payment</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment 1</label>
                            <input type="number" class="form-control" name="payment" id="payment"  aria-describedby="emailHelp">
                            {{-- @error('payment')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror --}}
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal"  aria-describedby="emailHelp">
                            {{-- @error('payment')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror --}}
                        </div>
                        <div class="mb-3">
                            <label for="via" class="form-label">Via</label>
                            <select class="form-control item-select" name="via" id="via">
                                <option selected>Pilih Metode Pembayaran</option>
                                    <option>Transfer</option>    
                                    <option>Cash</option>    
                            </select>
                            {{-- @error('payment')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection