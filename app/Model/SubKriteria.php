<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $fillable = [
        'id',
        'nama', 
        'id_kriteria', 
        'keterangan', 
        'bobot'
    ];
    protected $table = "sub_kriteria";

    public function kriteria()
    {
        return $this->belongsTo('App\Model\Kriteria', 'id_kriteria', 'id');
    }
}
