<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    use HasFactory;

    public $modelTranslate = 'Номенклатура дел';

    protected $fillable =[
        'number',
        'name',
        'part',
        'description',
        'year',
        'order',
    ];
    public function media()
    {
        return $this->hasMany('App\Models\Media');
    }
    public function documents()
    {
        return $this->belongsToMany('App\Models\Document')
            ->withTimestamps()
            ->withPivot(['page_start']);
    }
}
