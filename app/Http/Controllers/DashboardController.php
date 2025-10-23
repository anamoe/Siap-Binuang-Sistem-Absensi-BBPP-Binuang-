<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard_admin(){
        return view('admin');
    }
    public function dashboard_pegawai(){
        return view('pegawai');
    }
}
