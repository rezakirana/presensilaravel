<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejala';

    protected $fillable = [
        'kode',
        'gejala'
    ];

    public function rules()
    {
        return $this->hasMany('App\Model\Rule', 'gejala_id');
    }
}
