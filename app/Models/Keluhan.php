<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_ruangan',
        'id_user',
        'tanggal',
        'judul_kendala',
        'kendala',
        'image',
        'done'
    ];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function getImageAttribute($value)
    {
        return env('ASSET_URL').$value;
    }
}
