<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = ['name', 'iniciativa_id'];

    public function iniciativa()
    {
        return $this->belongsTo('App\Iniciativa');
    }
}
