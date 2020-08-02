<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judicial extends Model
{
    public function type()
    {
        return $this->belongsTo('App\JudicialType', 'type_id');
    }
}
