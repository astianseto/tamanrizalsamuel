<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AduanTemp;   // Tabel sementara
use App\Models\Aduan;       // Tabel utama
use App\Models\DetailAduan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnansweredExport;

class AdminController extends Controller
{
    // ============================================================
    // 🏠 DASHBOARD ADMIN
    // ============================================================
    public function index()
    {
        // Jumlah total aduan (approve + belum approve)
        $totalAduan = DB::table('aduan')->count() + DB::table('aduan_temp')->count();

        // Aduan bulan ini dari tabel aduan
        $aduanBulanIni = DB::table('aduan')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        // Sudah approve
        $aduanApprove = DB::table('aduan')->count();

        // Belum approve
        $aduanBelumApprove = DB::table('aduan_temp')->count();

        return view('admin.admin', compact(
            'totalAduan',
            'aduanBulanIni',
            'aduanApprove',
            'aduanBelumApprove'
        ));
    }

    // ============================================================
    // 📋 DAFTAR ADUAN SEMENTARA (BELUM APPROVE)
    // ============================================================
    public function aduanList()
    {
        $aduan = AduanTemp::latest()->get();
        return view('admin.aduantemp', compact('aduan'));
    }

    // ============================================================
    // ✅ APPROVE ADUAN
    // Pindahkan data dari AduanTemp → Aduan + DetailAduan
    // ============================================================
    public function approve($kode_aduan)
    {
        $temp = AduanTemp::where('kode_aduan', $kode_aduan)->first();

        if (! $temp) {
            return redirect()->route('admin.aduantemp')
                ->with('error', 'Data aduan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            // Simpan ke tabel utama
            Aduan::create([
                'kode_aduan' => $temp->kode_aduan,
                'nik' => $temp->nik,
                'nama' => $temp->nama,
                'alamat' => $temp->alamat ?? null,
                'telfon' => $temp->telfon,
                'aduan' => $temp->aduan,
                'file' => $temp->file,
                // 'kode_gambar' => $temp->kode_gambar ?? null,
            ]);

            // Buat detail awal (status diproses)
            DetailAduan::create([
                'kode_aduan' => $temp->kode_aduan,
                'status' => 'diproses',
                'jawaban' => '',
            ]);

            // Hapus dari tabel sementara
            $temp->delete();

            DB::commit();
            return redirect()->route('admin.aduantemp')->with('success', 'Aduan berhasil disetujui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.aduantemp')->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }

    // ============================================================
    // ❌ HAPUS SATU ADUAN SEMENTARA
    // ============================================================
    public function hapus($kode_aduan)
    {
        $aduan = AduanTemp::where('kode_aduan', $kode_aduan)->first();

        if ($aduan) {
            $aduan->delete();
            return redirect()->route('admin.aduantemp')
                ->with('success', 'Aduan berhasil dihapus!');
        }

        return back()->with('error', 'Aduan tidak ditemukan.');
    }

    // ============================================================
    // ⚠️ HAPUS SEMUA DATA SEMENTARA
    // ============================================================
    public function hapusSemua()
    {
        AduanTemp::truncate();
        return redirect()->route('admin.aduantemp')
            ->with('success', 'Semua aduan berhasil dihapus!');
    }

    // ============================================================
    // 📑 DAFTAR ADUAN SUDAH APPROVE
    // ============================================================
    public function showAduan(Request $request)
    {
            $aduan = Aduan::with('detailAduan');

            // Filter tanggal
            if ($request->start_date && $request->end_date) {
                $aduan->whereBetween('created_at', [$request->start_date, $request->end_date]);
            }

            // Filter status jawaban berdasarkan string jawaban
            if ($request->jawaban_status == 'sudah') {
                $aduan->whereHas('detailAduan', fn($q) => $q->where('jawaban', '!=', ''));
            } elseif ($request->jawaban_status == 'belum') {
                $aduan->whereHas('detailAduan', fn($q) => $q->where('jawaban', ''));
            }

            $aduan = $aduan->orderBy('created_at', 'desc')->get();

            return view('admin.aduan', compact('aduan'));
            }

    // ============================================================
    // ✏️ EDIT / JAWAB ADUAN
    // ============================================================
    public function edit($kode_aduan)
    {
        $aduan = Aduan::with('detailAduan')->where('kode_aduan', $kode_aduan)->firstOrFail();
        return view('admin.edit', compact('aduan'));
    }

    // ============================================================
    // 📊 EXPORT EXCEL ADUAN BELUM DIJAWAB
    // ============================================================
    public function exportUnanswered()
    {
        return Excel::download(new UnansweredExport, 'aduan_belum_dijawab.xlsx');
    }
}
