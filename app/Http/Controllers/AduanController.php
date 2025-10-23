<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aduan;

class AduanController extends Controller
{
    public function index()
    {
        // Tampilkan daftar aduan
        // $aduan = Aduan::latest()->get();
        // return view('aduan', compact('aduan'));

        $aduan = \App\Models\Aduan::latest()->paginate(6);
        return view('aduan', compact('aduan'));
    
    }

    public function create()
    {
        // Tampilkan form tambah aduan
        return view('form_aduan');
    }

    public function store(Request $request)
    {
        // Simpan data aduan ke database
        $validated = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'telfon' => 'required',
            'aduan' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('uploads', 'public');
        }

        Aduan::create($validated);

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil dikirim!');
    }

    public function show($id)
    {
        // Tampilkan detail aduan
        $aduan = Aduan::where('kode_aduan', $id)->firstOrFail();
        return view('detail_aduan', compact('aduan'));
    }


}
