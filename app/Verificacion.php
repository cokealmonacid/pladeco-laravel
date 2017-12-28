<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verificacion extends Model
{
	protected $table = 'verificaciones';

    protected $fillable = [
        'name', 'iniciativa_id', 'file'
    ];

    public function iniciativa()
    {
        return $this->belongsTo('App\Iniciativa');
    }
}
