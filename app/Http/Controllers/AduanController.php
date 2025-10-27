<?php

namespace App\Http\Controllers;

use App\Models\AduanTemp;
use App\Models\Aduan;
use App\Models\DetailAduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AduanController extends Controller
{
    /* ============================================================
     * 🏠 INDEX — Menampilkan daftar aduan dari tabel utama
     * ============================================================ */
    public function index()
    {
        $aduan = Aduan::latest()->paginate(6);
        return view('aduan', compact('aduan'));
    }

    /* ============================================================
     * ➕ CREATE — Form input aduan baru
     * ============================================================ */
    public function create()
    {
        return view('form_aduan');
    }

    /* ============================================================
     * 💾 STORE — Simpan aduan baru ke tabel sementara
     * ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telfon' => 'required',
            'aduan' => 'required',
            'file' => 'nullable|image|max:2048',
        ]);

        // Ambil kode terakhir dari tabel aduan
        $lastAduan = Aduan::orderBy('kode_aduan', 'desc')->first();
        $lastNumber = 0;

        if ($lastAduan && preg_match('/LSR-(\d+)/', $lastAduan->kode_aduan, $matches)) {
            $lastNumber = (int)$matches[1];
        }

        $newNumber = $lastNumber + 1;
        $newKode = 'LSR-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Upload file jika ada
        $path = $request->hasFile('file') ? $request->file('file')->store('aduan', 'public') : null;

        // Simpan ke tabel sementara
        AduanTemp::create([
            'kode_aduan' => $newKode,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telfon' => $request->telfon,
            'aduan' => $request->aduan,
            'file' => $path,
        ]);

        return redirect('/')
            ->with('success', 'Aduan berhasil dikirim! Nomor Aduan Anda: ' . $newKode);
    }

    /* ============================================================
     * 🔍 SHOW — Tampilkan detail aduan dari kedua tabel
     * ============================================================ */
    public function show($token)
    {
        try {
            $kode = Crypt::decryptString($token);
        } catch (\Exception $e) {
            abort(404); // Token tidak valid
        }

        // Cari di tabel utama
        $aduan = Aduan::with('detailAduan')->where('kode_aduan', $kode)->first();

        // Jika tidak ada, cari di tabel sementara
        if (!$aduan) {
            $aduan = AduanTemp::with('detailAduan')->where('kode_aduan', $kode)->first();
        }

        if (!$aduan) {
            abort(404);
        }

        return view('detail_aduan', compact('aduan'));
    }

    /* ============================================================
     * 🧩 SHOW ENCRYPTED — Versi lain untuk URL encoded
     * ============================================================ */
    public function showEncrypted($token)
    {
        try {
            $kode = Crypt::decryptString(rawurldecode($token));
        } catch (\Throwable $e) {
            abort(404);
        }

        // Sama, cek kedua tabel
        $aduan = Aduan::with('detailAduan')->where('kode_aduan', $kode)->first();
        if (!$aduan) {
            $aduan = AduanTemp::with('detailAduan')->where('kode_aduan', $kode)->first();
        }

        if (!$aduan) {
            abort(404);
        }

        return view('detail_aduan', compact('aduan'));
    }

    /* ============================================================
     * 🔎 CARI — Cari aduan berdasarkan kode_aduan di kedua tabel
     * ============================================================ */
    public function cari(Request $request)
    {
        $kode = trim($request->kode_aduan);

        $aduan = Aduan::with('detailAduan')->where('kode_aduan', $kode)->first();
        if (!$aduan) {
            $aduan = AduanTemp::with('detailAduan')->where('kode_aduan', $kode)->first();
        }

        if (!$aduan) {
            return redirect()->route('aduan.index')->with('not_found', true);
        }

        $encrypted = Crypt::encryptString($aduan->kode_aduan);
        return redirect()->route('aduan.show', ['token' => $encrypted]);
    }

    /* ============================================================
     * ✏️ EDIT & UPDATE — Admin edit jawaban aduan
     * ============================================================ */
    public function edit($kode_aduan)
    {
        $aduan = Aduan::with('detailAduan')->where('kode_aduan', $kode_aduan)->firstOrFail();
        return view('admin.edit', compact('aduan'));
    }

    public function update(Request $request, $kode_aduan)
    {
        $request->validate([
            'jawaban' => 'required|string',
            'status' => 'required|string',
        ]);

        DetailAduan::updateOrCreate(
            ['kode_aduan' => $kode_aduan],
            [
                'jawaban' => $request->jawaban,
                'status' => $request->status,
            ]
        );

        return redirect()->route('admin.aduan')->with('success', 'Jawaban berhasil disimpan!');
    }

    /* ============================================================
     * 🗑️ DESTROY — Hapus aduan sementara
     * ============================================================ */
    public function destroy($kode_aduan)
    {
        $aduan = AduanTemp::where('kode_aduan', $kode_aduan)->firstOrFail();
        $aduan->delete();

        return redirect()->route('dashboard')->with('success', 'Data aduan berhasil dihapus.');
    }
}
