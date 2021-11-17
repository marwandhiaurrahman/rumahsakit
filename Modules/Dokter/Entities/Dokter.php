<?php

namespace Modules\Dokter\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status', 'kode','spesialis'
    ];

    protected static function newFactory()
    {
        return \Modules\Dokter\Database\factories\DokterFactory::new();
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

}
