<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ruangan_id',
        'keluhan_id',
        'total_perbaikan',
        'reward',
        'response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class, 'keluhan_id', 'id');
    }
}
