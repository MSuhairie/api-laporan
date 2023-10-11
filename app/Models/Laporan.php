<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'type',
        'jenis',
        'tanggal',
        'waktu',
        'lokasi',
        'merk',
        'biaya',
        'status',
        'deskripsi',
        'foto',
        'foto_perbaikan',
        'kegiatan_perbaikan',
        'pihak_terlibat',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

}
