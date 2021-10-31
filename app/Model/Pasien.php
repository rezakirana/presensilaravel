<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'nama', 'alamat','nik','jk','ttl','user_id'
    ];

    public function antrians()
    {
        return $this->hasMany('App\Model\Antrian', 'pasien_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'user_id');
    }
}
