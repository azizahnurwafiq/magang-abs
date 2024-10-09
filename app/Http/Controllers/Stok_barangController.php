<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Stok_barangController extends Controller
{
    public function index()  {
        return view('stok_barang.index');
    }

    public function createbarang(){
        return view('stok_barang.createbarang');
    }
}
