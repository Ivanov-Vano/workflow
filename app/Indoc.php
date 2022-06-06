<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indoc extends Model
{
    protected $table = 'indocs';
    protected $filllable = [
        'num',
        'date',
        'outnum',
        'outdate',
        'text',
        'org_id'
    ];

    public function exemplars()
    {
        return $this->hasMany('App\Exemplar');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization', 'org_id');
    }
}
