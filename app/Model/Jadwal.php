<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'kelas_id', 'mapel_id', 'guru_id', 'tahun_ajaran_id', 'hari', 'jam_pelajaran', 'semester_id'
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas', 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Model\Mapel', 'mapel_id');
    }

    public function guru()
    {
        return $this->belongsTo('App\Model\Account', 'guru_id');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\Model\TahunAjaran', 'tahun_ajaran_id');
    }

    public function presensis()
    {
        return $this->hasMany('App\Model\Presensi', 'jadwal_id');
    }

    public function semester()
    {
        return $this->belongsTo('App\Model\Semester', 'semester_id');
    }
}
