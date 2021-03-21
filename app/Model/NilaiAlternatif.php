<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    protected $fillable = [
        'id_alternatif', 
        'id_sub_kriteria'
    ];
    protected $table = "nilai_alternatif";
    public $timestamps = false;

    public function sub_kriteria()
    {
        return $this->belongsTo('App\Model\SubKriteria', 'id_sub_kriteria', 'id');
    }

    public function alternatif()
    {
        return $this->belongsTo('App\Model\Alternatif', 'id_alternatif', 'id');
    }
}
