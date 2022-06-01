<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable =['name'];
    public function indocs()
    {
        return $this->hasMany(Indoc::class, 'org_id', 'id');
    }
}
