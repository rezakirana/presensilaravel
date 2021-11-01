<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $fillable = [
        'user_id', 'nama_dokter','jk','pendidikan_terakhir','poli_id'
    ];

    public function poli()
    {
        return $this->belongsTo('App\Model\Poli', 'poli_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function jadwals()
    {
        return $this->hasMany('App\Model\Jadwal', 'dokter_id');
    }
}
