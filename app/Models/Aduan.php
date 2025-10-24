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
        'kode_aduan',
        'nik',
        'nama',
        'alamat',
        'telfon',
        'aduan',
        'file',
    ];
    public function detail()
    {
        return $this->hasMany(DetailAduan::class, 'kode_aduan', 'kode_aduan');
    }

    /**
     * Relasi ke status terakhir (yang paling baru)
     */
    public function latestDetail()
    {
        return $this->hasOne(DetailAduan::class, 'kode_aduan', 'kode_aduan')->latestOfMany();
    }
    
}


