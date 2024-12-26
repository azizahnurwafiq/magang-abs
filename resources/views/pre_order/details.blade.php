@extends('dashboard.template')
@section('title', 'Detail stok barang')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="ml-2">Detail Pre Order</h3>
            <div class="card ml-2 mt-4">
                <div class="m-4">
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="kategori" class="form-label">Nama</label>
                                <p>
                                    {{$details->preOrder->nama_pelanggan}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">No Invoice</label>
                                <p>
                                    {{$details->preOrder->invoice->no_invoice}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Judul Artikel</label>
                                <p>
                                    {{$details->preOrder->judul_artikel}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Jenis pekerjaan</label>
                                <p>
                                    {{$details->pekerjaan->jenis_pekerjaan}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Status</label>
                                <p>
                                    {{$details->status}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Deadline</label>
                                <p>
                                    {{$details->deadline}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Bahan</label>
                                <p>
                                    {{$details->preOrder->bahan}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Warna</label>
                                <p>
                                    {{$details->preOrder->warna  ?? '-'}}
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Model</label>
                                <p>
                                    {{$details->preOrder->model ?? '-'}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            @php
                                $items = json_decode($details->item, true);
                                $quantities = json_decode($details->quantity, true);
                            @endphp
                                <div class="col-sm-4 col-4">
                                    <label for="item" class="form-label">Item</label>
                                    <p>
                                        @foreach ($items as $item)
                                            {{$item ?? '-'}}<br>  
                                        @endforeach
                                    </p>
                                </div>
                                <div class="col-sm-4 col-4">
                                    <label for="item" class="form-label">Quantity</label>
                                    <p>
                                        @foreach ($quantities as $quantity)
                                            {{$quantity ?? '-'}}<br>   
                                        @endforeach
                                    </p>
                                </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Note</label>
                                <p>
                                    {{$details->note}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Size</label>
                                <p>
                                    @foreach ($details->preOrder->sizes as $size)
                                        {{$size->size ?? '-'}}<br>
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Jumlah</label>
                                <p>
                                    @foreach ($details->preOrder->sizes as $jumlahs)
                                        {{$jumlahs->jumlah ?? '-'}}<br>
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Deskripsi</label>
                                <p>
                                    @foreach ($details->preOrder->sizes as $deskripsis)
                                        {{$deskripsis->deskripsi ?? '-'}}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Gambar</label>
                                <p>
                                    @foreach ($details->preOrder->images as $image)
                                        <img class="mt-3" src="{{ asset( 'storage/' . $image->image)}}" alt="Gambar {{$image->image}}" width="200">
                                    @endforeach
                                </p>
                            </div>

                            <div class="col-sm-4 col-4">
                                <label for="item" class="form-label">Note Produksi</label>
                                <p>
                                    {{$details->note_produksi ?? '-'}}
                                </p>
                            </div>
                            
                            <div class="col-sm-4 col-4">
                                @if (auth()->user()->role === 'produksi')
                                    <form action="{{route('produksi.preOrder.update', $details->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="note_produksi" class="form-label">Note Produksi</label>
                                        <textarea class="form-control" name="note_produksi" id="note_produksi" cols="20" rows="5" placeholder="Note produksi"></textarea>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 17rem; margin-top: 10px" data-toggle="modal" data-target="#deleteModal">Submit</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->role === 'admin')
                <a href="{{route('admin.preOrder.index')}}" class="btn btn-primary m-2">Kembali</a>
            @endif
            @if (auth()->user()->role === 'produksi')
                <a href="{{route('produksi.preOrder.index')}}" class="btn btn-primary m-2">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection