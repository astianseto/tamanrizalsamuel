<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanTemp extends Model
{
    use HasFactory;

    protected $table = 'aduan_temp';
    protected $primaryKey = 'kode_aduan';
    public $incrementing = false; // karena bukan auto-increment
    protected $keyType = 'string'; // tipe data kode_aduan adalah string
    
    protected $fillable = [
        'kode_aduan',
        'nik',
        'nama',
        'alamat',
        'telfon',
        'aduan',
        'file',
        'kode_gambar',
    ];

public function detailAduan()
{
    return $this->hasMany(DetailAduan::class, 'kode_aduan', 'kode_aduan');
}

}
