<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Nanti bisa tambahkan data statistik di sini
        return view('admin.dashboard');
    }
}