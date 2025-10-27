<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    use HasFactory;

    protected $table = 'aduan';
    protected $primaryKey = 'kode_aduan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_aduan', 'nik', 'nama', 'alamat', 'telfon', 'aduan', 'file', 'kode_gambar'
    ];

    // ============================================================
    // 🔹 RELASI KE DETAIL ADUAN
    // ============================================================
    public function detailAduan()
    {
        return $this->hasOne(DetailAduan::class, 'kode_aduan', 'kode_aduan', 'jawaban');
        // jika satu aduan punya beberapa jawaban, gunakan hasMany
        // return $this->hasMany(DetailAduan::class, 'kode_aduan', 'kode_aduan');
    }
}
