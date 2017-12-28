<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class temp extends Model
{
    protected $fillable = ['id_iniciativa', 'id_iniciativaT'];

    protected $table = 'temporal';
}
