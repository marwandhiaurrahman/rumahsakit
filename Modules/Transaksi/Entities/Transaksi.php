<?php

namespace Modules\Transaksi\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Perawatan\Entities\Perawatan;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode','perawatan_id','tipe','harga','keterangan','status',
    ];

    protected static function newFactory()
    {
        return \Modules\Transaksi\Database\factories\TransaksiFactory::new();
    }

    /**
     * Get the perawatan that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perawatan()
    {
        return $this->belongsTo(Perawatan::class);
    }
}
