<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    public $modelTranslate = 'Ранги';

    protected $fillable =[
        'name',
        'short_name'
    ];
    public function officers()
    {
        return $this->hasMany(Officer::class, 'rank_id');
    }
}
