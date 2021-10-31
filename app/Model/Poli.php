<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $fillable = [
        'kode', 'nama','gambar'
    ];

    public function dokters()
    {
        return $this->hasMany('App\Model\Dokter', 'poli_id');
    }
}
