<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
	protected $fillable= [
		'justify', 'objetive', 'area', 'responsable', 'coresponsable', 'status','componente_id', 'cartera'
	];

    public function componente()
    {
        return $this->belongsTo('App\Componente');
    }

    public function indicadores()
    {
    	return $this->hasMany('App\Indicador');
    }

    public function actividades()
    {
        return $this->hasMany('App\Actividad');
    }

    public function verificaciones()
    {
        return $this->hasMany('App\Verificacion');
    }
}
