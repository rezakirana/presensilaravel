<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $fillable = [
        'jadwal_id', 'pasien_id','tanggal_daftar','jam_daftar','no_antrian', 'status'
    ];

    public function pasien()
    {
        return $this->belongsTo('App\Model\Pasien', 'pasien_id');
    }

    public function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal', 'jadwal_id');
    }
}
