<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard_kanan');
    }

    // public function dashboard_kanan() {
    //     return view('dashboard.dashboard_kanan');
    // }
}
