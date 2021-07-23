<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'user_id',
        'periode_konsultasi',
        'gejala'
    ];

    public function belongsTo()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
