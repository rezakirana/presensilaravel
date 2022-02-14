<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $fillable = [
        'semester','status'
    ];

    public function jadwals()
    {
        return $this->hasMany('App\Model\Jadwal', 'semester_id');
    }
}
