<?php

namespace Modules\Pasien\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
