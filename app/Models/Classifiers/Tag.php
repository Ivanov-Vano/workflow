<?php

namespace App\Models\Classifiers;

use App\Models\Incoming;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $modelTranslate = 'Ключевые слова';

    protected $fillable =[
        'name',
    ];
    public function incomings()
    {
        return $this->morphedByMany(Incoming::class)->withTimestamps();
    }
}
