<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data aduan dari database (bisa batasi 5 terbaru)
        $aduan = Aduan::latest()->take(5)->get();

        // Hitung total aduan
        $totalAduan = Aduan::count();

        // Hitung aduan hari ini
        $aduanHariIni = Aduan::whereDate('created_at', today())->count();

        // Hitung aduan pending (ubah nama kolom 'status' jika berbeda)
        // $aduanPending = Aduan::where('status', 'pending')->count();

        // Kirim semua data ke view
        return view('admin.admin', compact('aduan', 'totalAduan', 'aduanHariIni'));
    }
}
