<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'id', 'nama', 'jenis'
    ];
    protected $table = "kriteria";

    public function sub_kriteria()
    {
        return $this->hasMany('App\Model\SubKriteria', 'id_kriteria', 'id');
    }

    public function bobot_kriteria()
    {
        return $this->hasMany('App\Model\BobotKriteria', 'id_kriteria', 'id');
    }
}
