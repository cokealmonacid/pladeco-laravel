<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lineamiento extends Model
{

    protected $fillable = [
        'name', 'user_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function objetivos()
    {
        return $this->hasMany('App\Objetivo');
    }

    public function componentes()
    {
        return $this->hasMany('App\Componente');
    }
}
