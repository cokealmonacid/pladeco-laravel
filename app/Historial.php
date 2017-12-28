<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';

    protected $fillable = [
        'accion', 'user_id', 'type'
    ];    
}
