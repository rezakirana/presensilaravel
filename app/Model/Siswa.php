<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'kelas_id', 'nis', 'nama', 'gender', 'tgl_lahir', 'tempat_lahir',
        'email', 'nama_ortu', 'alamat', 'phone_number'
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas', 'kelas_id');
    }
}
