<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Modules\Pasien\Entities\Pasien;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public function adminlte_image()
    {
        if (empty($this->foto)) {
            return asset('image/user.png');
        } else {
            return asset('storage/profile-image/' . $this->foto);
        }
    }

    protected $fillable = [
        'nik',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'alamat',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'agama',
        'status_kawin',
        'pekerjaan',
        'kewarganegaraan',
        'foto',
        'phone',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function desa()
    {
        return $this->belongsTo(Village::class, 'village_id', 'code');
    }
    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'district_id', 'code');
    }
    public function kabupaten()
    {
        return $this->belongsTo(City::class, 'city_id', 'code');
    }
    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'province_id', 'code');
    }
    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
