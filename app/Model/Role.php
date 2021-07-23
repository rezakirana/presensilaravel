<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'role',
        'description'
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id');
    }
}
