<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public $modelTranslate = 'Типы отправки/получения';

    protected $fillable =[
        'name',
        'short_name'
    ];
    public function document_incomings()
    {
        return $this->hasMany('App\Models\DocumentIncoming', 'option_id');
    }
    public function document_outgoings()
    {
        return $this->hasMany('App\Models\DocumentOutgoing', 'option_id');
    }
}
