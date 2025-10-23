<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    use HasFactory;

    protected $table = 'aduan';

    protected $fillable = [
        'kode_aduan',
        'nik',
        'nama',
        'alamat',
        'telfon',
        'aduan',
        'file',
    ];
}


