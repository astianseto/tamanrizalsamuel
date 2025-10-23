<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAduan extends Model
{
    use HasFactory;

    protected $table = 'detail_aduan';

    protected $fillable = [
        'kode_aduan',
        'status',
    ];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class, 'kode_aduan', 'kode_aduan');
    }
}
