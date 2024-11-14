<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Pdf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif; 
        }

        header{
            margin-top: -45px;
            margin-left: -45px;
            margin-right: -45px;
        }

        .table-borderless td, .table-borderless th {
            border: none;
        }
        .table-bordered td, .table-bordered th {
            border: 2px solid black;
        }
        .highlight {
            background-color: yellow;
        }

        .judul{
            margin-top: -140px;
        }

        .logo{
            margin-left: -88px;
        }

        .garis{
            margin-top: -90px;
            width: 100%;
            height: 1px;
            background-color: #c4c3c3;
        }

        .garis2{
            width: 100%;
            height: 1px;
            background-color: #c4c3c3;
        }

        section{
            width: 94%;
            margin-left: 20px;
        }

        .invoice{
            margin-top: -100px;
        }

        .invoice p{
            margin-top: -7px;
        }

        .invoice h3 span{
            font-size: 25px;
            font-family: Arial, sans-serif;
        }

        .row{
            display: flexbox;
            width: 100%;
            overflow: hidden;
        }

        .table-custom th {
            background-color: #b2000f;
            color: white;
        }
        .table-custom td, .table-custom th {
            padding: 10px;
        }

        .contact-info{
            margin-top: 55px;
        }

        .contact-item{
            margin-bottom: 10px;
        }

        footer{
            margin-top: -100px;
            margin-left: -45px;
            margin-right: -45px;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <header>
        @php
            $path = public_path('assets/dist/insatsu/atas_nontax.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $base64 }}" width="100%" height="150"/>
    </header>

    <section>
        <div class="judul">
            <div class="row">
                <div style="float: left; width: 50%;">
                    <div class="logo">
                        @php
                            $path = public_path('assets/dist/insatsu/insatsu.png');
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        @endphp
                        <img src="{{ $base64 }}" height="300"/>
                    </div>
                </div>
                <div style="float: right; width: 50%; margin-top: 130px;">
                    <p style="font-size: 40px; font-weight: bold; margin-left: 167px;">INVOICE</p>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>

        <div class="kode-date">
            <div class="garis"></div>
                <p style="margin-top: 15px;">{{$invoice->no_invoice}}</p>
                <p style="margin-top: -40px;" class="text-end">DATE: {{$invoice->tanggal}}</p>
            <div class="garis2"></div><br>
        </div>

        <div class="payable-to-bank-details">
            <div class="payable-to">
                <p style="font-weight: bold;">PAYABLE TO</p>
                <p style="margin-top: -5px;">{{$invoice->pelanggan->nama}}</p>
                <p style="margin-top: -10px;">{{ $invoice->pelanggan->alamat }}</p>
            </div>
            <div class="bank-details text-end" style="margin-top: -100px;">
                <p  style="font-weight: bold; ">BANK DETAILS</p>
                <p style="margin-top: -5px;">BCA - 510.0422.222</p>
                <p style="margin-top: -10px;">FAZA AMALY SULTHON</p>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">ITEM DESCRIPTION</th>
                        <th style="margin-left: -5px;">QTY</th>
                        <th>PRICE</th>
                        <th style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->invoice_stoks as $item)
                    <tr style="font-size: 15px;">
                        <td>{{ $item->stok->item }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>@rupiah($item->harga)</td>
                        <td>@rupiah($item->total)</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="contact-info">
            <p style="font-weight: bold; ">CONTACT INFO :</p>
            <div class="contact-item">
                @php
                    $path = public_path('assets/dist/insatsu/phone.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $base64 }}" width="24" height="24"/>
                <span style="margin-left: 5px;">08222 657 2700</span>
            </div>
            <div class="contact-item">
                @php
                    $path = public_path('assets/dist/insatsu/maps.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $base64 }}" width="24" height="24"/>
                <span style="margin-left: 5px; ">Jl. Dharmawangsa<br> no 54, lt. 1 60286,<br> Surabaya, Indonesia</span>
            </div>
        </div>

        <div class="total" style="margin-top: -120px;">
            <div class="sub-total">
                <p class="text-center" style="font-weight: bold; margin-left: 130px;">SUB TOTAL</p>
                <p class="text-end" style="margin-top: -50px;">@rupiah($invoice->total_invoice)</p>
            </div>
            <div class="down-payment">
                <p class="text-center" style="font-weight: bold; margin-left: 170px;">DOWN PAYMENT</p>
                <p class="text-end" style="margin-top: -50px;">@rupiah($invoice->down_payment)</p>
            </div>
            <div class="down-payment">
                <p class="text-center" style="font-weight: bold;  margin-left: 155px;">GRAND TOTAL</p>
                <p class="text-end" style="margin-top: -50px;">@rupiah($invoice->total_invoice)</p>
            </div>
        </div>

        <div>
            <p style="font-weight: bold; font-size: 22px; margin-left: 420px; margin-top: 40px;">THANK YOU!</p><br><br>
            <p style="font-size: 15px; margin-left: 440px; margin-top: 40px;">Administrator</p>
        </div>
    </section>

    <footer>
        <div class="contoh">

        </div>
        @php
            $path = public_path('assets/dist/insatsu/bawah_nontax.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $base64 }}" width="100%" height="150"/>
    </footer>
</body>
</html>