<?php

namespace Modules\Obat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'perawatan_id','obat_id','dosis','name','keterangan','stok','harga','status'
    ];

    protected static function newFactory()
    {
        return \Modules\Obat\Database\factories\ResepFactory::new();
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

}
