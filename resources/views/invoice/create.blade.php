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
                        <div class="d-flex col-md-12">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <select class="form-control  form-select" name="kode" id="kode" required>
                                        <option selected>--Pilih kode--</option>
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
                                    <select class="form-control form-select" name="pelanggan_id" id="pelanggan_id" required>
                                        <option selected>--Pilih pelanggan--</option>
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" id="judul" required>
                                    @error('note')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div id="dynamicForm">
                                    <div class="form-group d-flex">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="item" class="form-label">Item</label>
                                                <select class="form-control item-select" name="item[]" id="item">
                                                    <option selected></option>
                                                    @foreach ($stoks as $stok)
                                                        <option value="{{$stok->id}}">{{$stok->item}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-md-4">
                                            <div class="form-harga mb-3"> 
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga[]" id="harga" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input type="number" id="jumlah" min="0" class="form-control" name="jumlah[]" required>
                                            </div>
                                        </div>
                                        <button class="btn btn-success btn-add" style="height: 50%; margin-top:32px; margin-left: 5px;">+</button>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="number" class="form-control" name="total" id="total" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="down_payment" class="form-label">Down Payment</label>
                                    <input type="number" class="form-control" name="down_payment" id="down_payment">
                                    @error('note')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">
@endpush


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script>
    <script>

        $(document).ready(function(){
            $('#item').select2({
                placeholder: 'Pilih item',
                allowClear: true
            })
        });

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

        // mengambil alamat otomatis berdasarkan pelanggan yang dipilih 
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

        $(document).ready(function() {

            // Fungsi untuk memperbarui harga dan total
            function updateTotal() {
                let total = 0;
                $('#dynamicForm .form-group').each(function() {
                    const harga = parseInt($(this).find('#harga').val()) || 0;
                    const jumlah = parseInt($(this).find('#jumlah').val()) || 0;
                    total += harga * jumlah;
                });
                $('#total').val(total);
            }

            // repeater data item, harga, dan jumlah
            $('#dynamicForm').on('click', '.btn-add', function() {
                let newField = `<div class="form-group d-flex">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <select class="form-control item-select" name="item[]" id="item">
                                                <option selected></option>
                                                @foreach ($stoks as $stok)
                                                    <option value="{{$stok->id}}">{{$stok->item}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-harga mb-3"> 
                                            <input type="text" class="form-control" name="harga[]" id="harga" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <input type="number" id="jumlah" min="0" class="form-control" name="jumlah[]" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-remove" style="height: 50%; margin-left: 5px;">-</button>
                                </div>`;
                                
                                $('#dynamicForm').append(newField);

                                $('#dynamicForm').find('select').last().select2({
                                    placeholder: 'Pilih item',
                                    allowClear: true
                                });
            });

            $('#dynamicForm').on('click', '.btn-remove', function(){
                $(this).closest('.d-flex').remove();
                updateTotal();
            });


            // mengambil harga otomatis berdasarkan item yang dipilih
            $('#dynamicForm').on('change', '.item-select', function() {
                let stokId =  $(this).val();
                let harga = $(this).closest('.form-group').find('#harga');

                $.ajax({
                    url: '/get-harga-item/' + stokId,
                    type: 'GET',
                    data: {id: stokId},
                    success: function(response){
                        harga.val(response.harga_jual);
                    },
                    error: function() {
                        alert('Gagal mengambil harga item');
                    }
                })
            });

            // Event listener untuk perubahan jumlah
            $('#dynamicForm').on('input', '#jumlah', function() {
                updateTotal();
            });
        });
    </script>
@endpush