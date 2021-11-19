<?php

namespace Modules\Poliklinik\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dokter\Entities\Dokter;
use Modules\Perawatan\Entities\Perawatan;

class Poliklinik extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','kode','dokter_id','status'
    ];

    protected static function newFactory()
    {
        return \Modules\Poliklinik\Database\factories\PoliklinikFactory::new();
    }

    /**
     * Get the user that owns the Poliklinik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function perawatans()
    {
        return $this->hasMany(Perawatan::class);
    }

}
