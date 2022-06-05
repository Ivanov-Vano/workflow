<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indoc extends Model
{
    public function exemplars()
    {
        return $this->hasMany('App\Exemplar');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization', 'org_id');
    }
}
