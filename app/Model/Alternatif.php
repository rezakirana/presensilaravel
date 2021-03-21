<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = [
        'nama',
        'gambar'
    ];
    protected $table = "alternatif";

    public function nilai_alternatif()
    {
        return $this->hasMany('App\Model\NilaiAlternatif', 'id_alternatif', 'id');
    }
}
