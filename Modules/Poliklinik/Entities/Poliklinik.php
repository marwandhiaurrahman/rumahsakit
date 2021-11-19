<?php

namespace Modules\Poliklinik\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poliklinik extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Poliklinik\Database\factories\PoliklinikFactory::new();
    }
}
