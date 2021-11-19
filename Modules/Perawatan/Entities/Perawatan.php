<?php

namespace Modules\Perawatan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dokter\Entities\Dokter;
use Modules\Obat\Entities\Resep;
use Modules\Pasien\Entities\Pasien;
use Modules\Poliklinik\Entities\Poliklinik;

class Perawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal','kode','pasien_id','poliklinik_id','pelayanan','status','awal_perawatan','akhir_perawatan','keluhan','analisis','keterangan'
    ];

    protected static function newFactory()
    {
        return \Modules\Perawatan\Database\factories\PerawatanFactory::new();
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }
    public function dokter()
    {
        return $this->poliklinik->dokter();
    }
    public function reseps()
    {
        return $this->hasMany(Resep::class, 'perawatan_id', 'id');
    }
}
