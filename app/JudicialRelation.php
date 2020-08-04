<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudicialRelation extends Model
{
    public function judicial()
    {
        return $this->belongsTo('App\Judicial', 'judicial_id', "id");
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id', 'id');
    }

}
