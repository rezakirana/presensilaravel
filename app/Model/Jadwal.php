<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'dokter_id', 'hari','jam_praktik'
    ];

    public function dokter()
    {
        return $this->belongsTo('App\Model\Dokter', 'dokter_id');
    }

    public function antrians()
    {
        return $this->hasMany('App\Model\Antrian', 'jadwal_id');
    }
}
