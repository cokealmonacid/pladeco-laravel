<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{

    protected $fillable = [
        'name', 'objetive', 'lineamiento_id'
    ];

    public function lineamiento()
    {
        return $this->belongsTo('App\Lineamiento');
    }

    public function iniciativas()
    {
        return $this->hasMany('App\Iniciativa');
    }
}
