<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';

    protected $fillable = [
        'kode',
        'gejala',
        'probabilitas',
        'keterangan',
        'penanganan',
        'image'
    ];

    public function rules()
    {
        return $this->hasMany('App\Model\Rule', 'penyakit_id');
    }
}
