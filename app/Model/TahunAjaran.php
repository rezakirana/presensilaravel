<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $fillable = [
        'tahun_ajaran'
    ];

    public function jadwals()
    {
        return $this->hasMany('App\Model\Jadwal', 'tahun_ajaran_id');
    }
}
