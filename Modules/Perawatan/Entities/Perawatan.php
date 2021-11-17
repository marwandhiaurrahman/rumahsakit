<?php

namespace Modules\Perawatan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode','pasien_id','dokter_id','pelayanan','spesialis','status','awal_perawatan','akhir_perawatan','resep_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Perawatan\Database\factories\PerawatanFactory::new();
    }
}
