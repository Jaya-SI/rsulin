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
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function getImageAttribute($value)
    {
        return env('ASSET_URL').$value;
    }
}
