<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $fillable = [
        'jadwal_id', 'tanggal', 'materi_pertemuan', 'silabus', 'data','pertemuan'
    ];

    public function jadwal()
    {
        return $this->belongsTo('App\Model\Jadwal', 'jadwal_id');
    }

    protected $dates = ['tanggal'];
}
