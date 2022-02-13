<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'guru';
    protected $fillable = [
        'user_id','nip', 'nama', 'tgl_lahir', 'tempat_lahir',
        'gender', 'phone_number', 'email', 'alamat', 'pendidikan'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function jadwals()
    {
        return $this->hasMany('App\Model\Jadwal', 'guru_id');
    }
}
