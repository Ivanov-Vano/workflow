<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function indocs()
    {
        return $this->hasMany(Indoc::class, 'org_id', 'id');
    }
}
