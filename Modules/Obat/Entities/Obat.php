<?php

namespace Modules\Obat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'name', 'stok', 'satuan', 'manfaat', 'keterangan', 'harga',
    ];

    protected static function newFactory()
    {
        return \Modules\Obat\Database\factories\ObatFactory::new();
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}
