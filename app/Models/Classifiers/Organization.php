<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public $modelTranslate = 'Организации';

    protected $fillable =[
        'name',
        'short_name'
    ];
    public function document_incomings()
    {
        return $this->hasMany('App\Models\DocumentIncoming');
    }
}
