@extends('dashboard.template')
@section('title', 'Tambah data invoice')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Tambah data Invoice</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    @if (request()->is('admin*'))
                    <form action="{{route('admin.invoice.store')}}" method="POST">
                        @elseif (request()->is('manager*'))
                        <form action="{{route('manager.invoice.store')}}" method="POST">
                            @endif
                            @csrf
                            <div class="d-flex col-md-12">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kode" class="form-label">Kode</label>
                                        <select class="form-control form-select" name="kode" id="kode" required>
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
                                            <option selected>--Pilih nama pelanggan--</option>
                                            @foreach ($pelanggans as $pelanggan)
                                            <option value={{$pelanggan->id}}> {{$pelanggan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control" name="judul" id="judul" value="{{ @old('judul')}}">
                                        @error('judul')
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
                                                    <input type="number" id="jumlah" class="form-control" name="jumlah[]">
                                                    <p id="errorStok" class="text-danger form-text"></p>
                                                    @error('jumlah')
                                                        <div class="form-text text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-success btn-add" style="height: 50%; margin-top:32px; margin-left: 5px;">+</button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="total" class="form-label">Total</label>
                                        <input type="number" class="form-control" name="total" id="total" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="down_payment" class="form-label">Down Payment</label>
                                        <input type="number" class="form-control" name="down_payment" id="down_payment" value="{{ @old('down_payment')}}">
                                        @error('down_payment')
                                        <div class="form-text text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-3">Submit</button>
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

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">
@endpush


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script>
<script>
    // Menentukan Role User
    const userRole = "{{ request()->is('admin*') ? 'admin' : 'manager' }}";

    $(document).ready(function() {
        $('#item').select2({
            placeholder: 'Pilih item',
            allowClear: true
        });
    });

    document.getElementById('kode').addEventListener('change', function() {
        const tipeKode = this.value;

        if (tipeKode) {
            fetch(`/${userRole}/generate-invoice-number`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        kode: tipeKode
                    })
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

    // Mengambil alamat otomatis berdasarkan pelanggan yang dipilih
    $(document).ready(function() {
        $('#pelanggan_id').change(function() {
            let pelangganId = $(this).val();

            if (pelangganId) {
                $.ajax({
                    url: `/${userRole}/get-alamat-pelanggan/${pelangganId}`,
                    type: 'GET',
                    success: function(response) {
                        $('#alamat').val(response.alamat);
                    },
                    error: function() {
                        alert('Gagal mengambil data alamat pelanggan');
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

        // Repeater data item, harga, dan jumlah
        $('#dynamicForm').on('click', '.btn-add', function() {
            let newField = `
                <div class="form-group d-flex">
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
                            <input type="number" id="jumlah" class="form-control" name="jumlah[]">
                            <p id="errorStok" class="text-danger form-text"></p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-remove" style="height: 50%; margin-left: 5px;">-</button>
                </div>`;

            $('#dynamicForm').append(newField);

            $('#dynamicForm').find('select').last().select2({
                placeholder: 'Pilih item',
                allowClear: true
            });
        });

        $('#dynamicForm').on('click', '.btn-remove', function() {
            $(this).closest('.d-flex').remove();
            updateTotal();
        });

        // Mengambil harga otomatis berdasarkan item yang dipilih
        $('#dynamicForm').on('change', '.item-select', function() {
            let stokId = $(this).val();
            let harga = $(this).closest('.form-group').find('#harga');

            $.ajax({
                url: `/${userRole}/get-harga-item/${stokId}`,
                type: 'GET',
                data: {
                    id: stokId
                },
                success: function(response) {
                    harga.val(response.harga_jual);
                },
                error: function() {
                    alert('Gagal mengambil harga item');
                }
            });
        });

        // Event listener untuk perubahan jumlah
        $('#dynamicForm').on('input', '#jumlah', function() {
            updateTotal();
        });

        // Mengecek jumlah stok 
        $('#dynamicForm').on('change', '.item-select', function () {
            let stokId = $(this).val();
            let parentDiv = $(this).closest('.form-group');
    
            if (stokId) {
                $.ajax({
                    url: `/${userRole}/get-jumlah-stok/${stokId}`,
                    type: 'GET',
                    success: function (response) {
                        parentDiv.find('#jumlah').data('stok', response.total_stok);
                        console.log(response)
                    },
                    error: function () {
                        alert('Gagal mengambil data stok!');
                    }
                });
            }
        });

        $('#dynamicForm').on('input', '#jumlah', function () {
            let jumlah = parseInt($(this).val());
            let stokTersedia = $(this).data('stok');
            let parentDiv = $(this).closest('.form-group');
    
            if (jumlah > stokTersedia) {
                parentDiv.find('#errorStok').text('Jumlah stok tidak mencukupi !!');
            } else {
                parentDiv.find('#errorStok').text('');
            }
        });

    });
</script>
@endpush