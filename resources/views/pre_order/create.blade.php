@extends('dashboard.template')
@section('title', 'Input data PO')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Input PO</h3>
            <div class="card ml-2 mt-4">
                <form action="" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_id" class="form-label">No Invoice</label>
                                    <select class="form-control form-select" name="invoice_id" id="invoice_id" required>
                                        <option selected>--Pilih No Invoice--</option>
                                        @foreach ($invoices as $invoice)
                                            <option value={{$invoice->id}}>{{$invoice->no_invoice}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pelanggan" class="form-label">Nama pelanggan</label>
                                    <input type="text" class="form-control" name="pelanggan" id="pelanggan" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul artikel</label>
                                    <input type="text" class="form-control" name="judul" id="judul" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                    {{-- @error('note')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror --}}
                                </div>
                                <div class="mb-3">
                                    <label for="bahan" class="form-label">Bahan</label>
                                    <input type="text" id="bahan" class="form-control" name="bahan">
                                </div>
                                <div class="mb-3">
                                    <label for="item" class="form-label">Item <span class="text-red">(pilih salah satu)</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkbox1" name="checkbox1" style="border: 1px solid rgb(124, 124, 124)">
                                        <label class="form-check-label" for="checkbox1">
                                            SAMA DENGAN INVOICE
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkbox2" name="checkbox2" style="border: 1px solid rgb(124, 124, 124)">
                                        <label class="form-check-label" for="checkbox2">
                                            SIZE
                                        </label>
                                    </div>

                                    <div id="dynamicForm1">
                                        <div class="form-group d-flex" style="margin-left: -10px;">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label for="item" class="form-label">Item</label>
                                                    <input type="text" id="item" class="form-control" name="item">
                                                </div> 
                                            </div>  
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input type="text" id="quantity" class="form-control" name="quantity">
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-add" id="btn-add" style="height: 50%; margin-top:32px; margin-left: 5px;">+</button>
                                        </div>
                                    </div>  
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" id="model" class="form-control" name="model">
                                </div>
                                <div class="mb-3">
                                    <label for="warna" class="form-label">Warna</label>
                                    <input type="text" id="warna" class="form-control" name="warna">
                                </div>

                                <div id="dynamicForm2">
                                    <div class="form-group d-flex">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan</label>
                                                <select class="form-control item-select form-select" name="jenis_pekerjaan" id="jenis_pekerjaan">
                                                    <option selected>--Pilih jenis pekerjaan--</option>
                                                        <option>DTF</option>    
                                                        <option>Sublim</option>    
                                                        <option>Konveksi</option>    
                                                        <option>Grafir</option>    
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="deadline" class="form-label">Deadline</label>
                                                <input type="date" id="deadline"class="form-control" name="deadline">
                                            </div>
                                        </div>
                                        <button class="btn btn-success btn-add" style="height: 50%; margin-top:32px; margin-left: 5px;">+</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage()">
                                    <img class="img-preview img-fluid mt-2 col-sm-8">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mx-3 my-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection




@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // logic checkbox
    document.getElementById('checkbox1').addEventListener('change', function () {
        if (this.checked) {
            document.getElementById('checkbox2').checked = false;
        }
    });
    document.getElementById('checkbox2').addEventListener('change', function () {
        if (this.checked) {
            document.getElementById('checkbox1').checked = false;
        }
    });

    // repeater data jenis pekejaan dan deadline
    $('#dynamicForm2').on('click', '.btn-add', function() {
        let newField = `<div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <select class="form-control item-select form-select" name="jenis_pekerjaan" id="jenis_pekerjaan">
                                                <option selected>Pilih jenis pekerjaan</option>
                                                    <option>DTF</option>    
                                                    <option>Sublim</option>    
                                                    <option>Konveksi</option>    
                                                    <option>Grafir</option>   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <input type="date" id="deadline" class="form-control" name="deadline">
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-remove" style="height: 50%; margin-left: 5px;">-</button>
                                </div>`;
                                
                                $('#dynamicForm2').append(newField);
    });
    $('#dynamicForm2').on('click', '.btn-remove', function(){
            $(this).closest('.d-flex').remove();
    });

    // repeater data item dan quantity
    $('#dynamicForm1').on('click', '.btn-add', function() {
        let newField = `<div class="form-group d-flex" style="margin-left: -10px;">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <input type="text" id="item" class="form-control" name="item">
                                                </div> 
                                            </div>  
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <input type="text" id="quantity" class="form-control" name="quantity">
                                                </div>
                                            </div>
                                            <button class="btn btn-danger btn-remove" style="height: 50%; margin-left: 5px;">-</button>
                                    </div>`;
                                
                        $('#dynamicForm1').append(newField);
    });
    $('#dynamicForm1').on('click', '.btn-remove', function(){
            $(this).closest('.d-flex').remove();
    });


    // mengambil nama pelanggan dan judul otomatis berdasarkan no invoice yang dipilih 
    $(document).ready(function() {
        $('#invoice_id').change(function(){
                let InvoiceId = $(this).val();

                if(InvoiceId){
                    $.ajax({
                        url: '/get-nama-pelanggan/' + InvoiceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            if(response.pelanggan && response.judul){
                                $('#pelanggan').val(response.pelanggan);
                                $('#judul').val(response.judul);
                            } else {
                                $('#pelanggan').val('');
                                $('#judul').val('');
                                alert('Data tidak ditemukan.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error: ', status, error);
                            alert('Gagal mengambil data. Silakan coba lagi.');
                        }
                    });
                } else {
                    $('#pelanggan').val('');
                    $('#judul').val('');
                }
            }); 
    });

    // menampilkan gambar saat memilih
    function previewImage(){
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
    }

    //mengambil item dan quantity berdasarkan no invoice jika checkbox sama dengan invoice dicentang
    $(document).ready(function() {
        $('#checkbox1').change(function() {
            let isChecked = $(this).is(':checked'); 
            let invoiceId = $('#invoice_id').val();

            if(isChecked && invoiceId){
                $.ajax({
                    url: '/get-invoice-items/' + invoiceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        if(response.items && response.items.length > 0) {
                            $('#dynamicForm1').empty();

                            //Loop melalui item yang dikembalikan
                            response.items.forEach(function(item, index) {
                                $('#dynamicForm1').append(`
                                        <div class="form-group d-flex" style="margin-left: -10px;">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label for="item" class="form-label">Item</label>
                                                    <input type="text" id="item" class="form-control" value="${item.item}" readonly>
                                                </div> 
                                            </div>  
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input type="text" id="quantity" class="form-control" value="${item.quantity}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                `);
                            });
                            $('#btn-add').hide();
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Gagal mengambil data item.');
                    }
                })
            } else {
                // kosongkan jika repeater tidak dicentang
                $('#dynamicForm1').html(`
                    <div class="form-group d-flex" style="margin-left: -10px;">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label for="item" class="form-label">Item</label>
                                                    <input type="text" id="item" class="form-control" name="item">
                                                </div> 
                                            </div>  
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input type="text" id="quantity" class="form-control" name="quantity">
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-add" id="btn-add" style="height: 50%; margin-top:32px; margin-left: 5px;">+</button>
                                        </div>
                `);
            }
        });
    });


</script>
@endpush