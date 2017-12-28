<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';

    protected $fillable = ['name', 'iniciativa_id'];

    public function iniciativa()
    {
        return $this->belongsTo('App\Iniciativa');
    }
}
