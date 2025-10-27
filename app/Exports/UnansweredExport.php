<?php

namespace App\Exports;

use App\Models\Aduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UnansweredExport implements FromCollection, WithHeadings, WithMapping
{
    // Ambil aduan yang belum dijawab
    public function collection()
    {
        return Aduan::with('detailAduan')
            ->whereHas('detailAduan', fn($q) => $q->where('jawaban', ''))
            ->get();
    }

    // Judul kolom Excel
    public function headings(): array
    {
        return [
            'Kode Aduan',
            'NIK',
            'Nama',
            'Alamat',
            'Telepon',
            'Aduan',
            'Tanggal Dibuat',
            'Link Gambar'
        ];
    }

    // Mapping tiap baris, format sesuai request
    public function map($aduan): array
    {
        return [
            $aduan->kode_aduan,
            "'" . $aduan->nik, // tambahkan prefix +15
            $aduan->nama,
            $aduan->alamat,
            $aduan->telfon,
            $aduan->aduan,
            $aduan->created_at->format('d F Y'), // format dd MMMM yyyy
            $aduan->file ? asset('storage/' . $aduan->file) : '-' // link gambar
        ];
    }
}
