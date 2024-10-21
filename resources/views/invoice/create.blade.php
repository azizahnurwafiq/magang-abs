@extends('dashboard.template')
@section('title', 'Tambah data invoice')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Tambah data Invoice</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <form action="{{route('invoice.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <select class="form-control" name="kode" id="kode" required>
                                <option selected>Pilih Kode</option>
                                    <option value="tax">TAX</option> 
                                    <option value="non_tax">NON TAX</option> 
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="no_invoice" class="form-label">Nomor Invoice</label>
                            <input type="text" class="form-control" name="no_invoice" id="no_invoice" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pelanggan_id" class="form-label">Nama</label>
                            <select class="form-control" name="pelanggan_id" id="pelanggan_id" required>
                                <option selected>Pilih Pelanggan</option>
                                @foreach ($pelanggans as $pelanggan)
                                    <option value={{$pelanggan->id}}>{{$pelanggan->nama}}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                            @error('note')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" required>
                            @error('note')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok_id" class="form-label">Item</label>
                            <select class="form-control" name="stok_id" id="stok_id">
                                <option selected>Pilih Item</option>
                                @foreach ($stoks as $stok)
                                    <option value={{$stok->id}}>{{$stok->item}}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <select class="form-control" name="harga" id="harga" required>
                                <option selected>Pilih Harga</option>
                                @foreach ($stoks as $stok)
                                    <option value={{$stok->harga_jual}}>{{($stok->harga_jual)}}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" id="jumlah" min="0" class="form-control" name="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="total">Total</label>
                            <input type="text" id="total" name="total" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pembayaran_awal" class="form-label">Pembayaran</label>
                            <input type="number" class="form-control" name="pembayaran_awal" id="pembayaran_awal" required>
                            @error('note')
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


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        document.getElementById('kode').addEventListener('change', function() {
            const tipeKode = this.value;

            if(tipeKode){
                fetch('/generate-invoice-number', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ kode: tipeKode })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('no_invoice').value = data.no_invoice;
                })
                .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('no_invoice').value = '';
            }
        });

        $(document).ready(function() {
            $('#pelanggan_id').change(function(){
                let pelangganId = $(this).val();

                if(pelangganId){
                    $.ajax({
                        url: '/get-alamat-pelanggan/' + pelangganId,
                        type: 'GET',
                        success: function(response){
                            $('#alamat').val(response.alamat);
                        }
                    });
                } else {
                    $('#alamat').val('');
                }
            }); 
        });

        // menghitung harga dan jumlah
        document.addEventListener('DOMContentLoaded', function() {
            const hargaSelect = document.getElementById('harga');
            const jumlahInput = document.getElementById('jumlah');
            const total = document.getElementById('total');
    
            function hitungTotal(){
                const harga = parseInt(hargaSelect.value);
                const jumlah = parseInt(jumlahInput.value);
    
                console.log("harga:", harga); // Debug harga
                console.log("jumlah:", jumlah); // Debug harga
                

                if (!isNaN(harga) && !isNaN(jumlah > 0)) {
                    const total = harga * jumlah;
                    // total.value = `Rp ${total.toLocaleString()}`;
                    console.log("total:", total);
                } else {
                    total.value = '';
                }
    
            }
            
            hargaSelect.addEventListener('change', hitungTotal);
            jumlahInput.addEventListener('input', hitungTotal);
    
            hitungTotal();
        });
        
    </script>
@endpush