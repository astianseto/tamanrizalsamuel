<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function index()
    {
        // Ambil semua data aduan dari database
        $aduan = Aduan::latest()->get();

        // Kirim ke view dashboard
        return view('admin.admin', compact('aduan'));
    }

    
}
