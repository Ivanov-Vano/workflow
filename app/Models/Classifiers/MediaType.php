<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    use HasFactory;

    public $modelTranslate = 'Типы носителей';

    protected $fillable =[
        'name',
        'short_name',
    ];
    public function media()
    {
        return $this->hasMany('App\Models\Media');
    }
}
