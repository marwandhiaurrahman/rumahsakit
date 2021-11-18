<?php

namespace Modules\Transaksi\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode','perawatan_id','tipe','harga','ketarangan','status'
    ];

    protected static function newFactory()
    {
        return \Modules\Transaksi\Database\factories\TransaksiFactory::new();
    }
}
