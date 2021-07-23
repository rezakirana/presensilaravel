<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rule';

    protected $fillable = [
        'gejala_id',
        'penyakit_id',
        'bobot'
    ];

    public function gejala()
    {
        return $this->belongsTo('App\Model\Gejala', 'gejala_id');
    }

    public function penyakit()
    {
        return $this->belongsTo('App\Model\Penyakit', 'penyakit_id');
    }
}
