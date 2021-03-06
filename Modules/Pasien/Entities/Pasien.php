<?php

namespace Modules\Pasien\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravolt\Indonesia\Models\Village;
use Modules\Perawatan\Entities\Perawatan;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status', 'kode'
    ];

    protected static function newFactory()
    {
        return \Modules\Pasien\Database\factories\PasienFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function desa()
    {
        return $this->user->desa();
    }
    public function kecamatan()
    {
        return $this->user->kecamatan();
    }
    public function kabupaten()
    {
        return $this->user->kabupaten();
    }
    public function provinsi()
    {
        return $this->user->provinsi();
    }
    /**
     * Get all of the perawatans for the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perawatans()
    {
        return $this->hasMany(Perawatan::class);
    }
}
