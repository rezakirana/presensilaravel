<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    protected $fillable = [
        'id_kriteria', 
        'id_user', 
        'bobot'
    ];
    protected $table = "bobot_kriteria";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user', 'id');
    }

    public function kriteria()
    {
        return $this->belongsTo('App\Model\Kriteria', 'id_kriteria', 'id');
    }
}
