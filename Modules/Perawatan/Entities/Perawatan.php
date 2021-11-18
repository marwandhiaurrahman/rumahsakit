<?php

namespace Modules\Perawatan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dokter\Entities\Dokter;
use Modules\Obat\Entities\Resep;
use Modules\Pasien\Entities\Pasien;

class Perawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal','kode','pasien_id','dokter_id','pelayanan','spesialis','status','awal_perawatan','akhir_perawatan','resep_id','keluhan','analisis','keterangan'
    ];

    protected static function newFactory()
    {
        return \Modules\Perawatan\Database\factories\PerawatanFactory::new();
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function reseps()
    {
        return $this->hasMany(Resep::class, 'perawatan_id', 'id');
    }
}
