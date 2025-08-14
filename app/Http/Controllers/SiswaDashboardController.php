<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        // Nanti bisa tambahkan data untuk siswa di sini
        return view('siswa.dashboard');
    }
}