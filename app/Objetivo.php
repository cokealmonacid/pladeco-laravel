<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = [
        'description', 'lineamiento_id'
    ];

    public function lineamiento()
    {
        return $this->belongsTo('App\Lineamiento');
    }
}
