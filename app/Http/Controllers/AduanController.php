<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aduan;
use App\Models\DetailAduan;
use Illuminate\Support\Facades\Crypt;

class AduanController extends Controller
{
    public function index()
    {
        $aduan = Aduan::latest()->paginate(6);
        return view('aduan', compact('aduan'));
    }

    public function create()
    {
        return view('form_aduan');
    }

    public function store(Request $request)
    {
$validated = $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'telfon' => 'required|string|max:20',
            'aduan' => 'required|string',
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Generate kode_aduan unik
        $tanggal = now()->format('Ymd');
        $prefix = 'LSR' . $tanggal . '-';

        $lastAduan = Aduan::where('kode_aduan', 'like', $prefix . '%')
            ->orderBy('kode_aduan', 'desc')
            ->first();

        if ($lastAduan) {
            $lastNumber = (int) substr($lastAduan->kode_aduan, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kode_aduan = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // ✅ Upload file jika ada
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('aduan', 'public');
        }

        // ✅ Simpan ke database
        Aduan::create([
            'kode_aduan' => $kode_aduan,
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'telfon' => $validated['telfon'],
            'aduan' => $validated['aduan'],
            'file' => $path,
        ]);
        
        DetailAduan::create([
            'kode_aduan' => $kode_aduan,
            'status' => 'sedang ditinjau',
        ]);


        return redirect()->back()->with('success', "Laporan berhasil dikirim! Kode Aduan Anda: $kode_aduan");
    }

public function show($token)
{
    try {
        $kode = \Illuminate\Support\Facades\Crypt::decryptString($token);
    } catch (\Exception $e) {
        abort(404); // kalau token tidak valid
    }

    $aduan = \App\Models\Aduan::where('kode_aduan', $kode)->firstOrFail();

    return view('detail_aduan', compact('aduan'));
}
 

public function showEncrypted($token)
{
    try {
        $kode = Crypt::decryptString(rawurldecode($token));
    } catch (\Throwable $e) {
        abort(404);
    }

    $aduan = Aduan::where('kode_aduan', $kode)->firstOrFail();
    return view('detail_aduan', compact('aduan'));
}

public function cari(Request $request)
{
    $kode = trim($request->kode_aduan);

    // Cari aduan berdasarkan kode_aduan
    $aduan = \App\Models\Aduan::where('kode_aduan', $kode)->first();

    if ($aduan) {
        // Redirect langsung ke halaman detail
        $encrypted = Crypt::encryptString($aduan->kode_aduan);
        return redirect()->route('aduan.show', ['token' => $encrypted]);
    }

    // Jika tidak ditemukan, kembali ke daftar aduan dengan pesan
    return redirect()->route('aduan.index')->with('not_found', true);
}

}
