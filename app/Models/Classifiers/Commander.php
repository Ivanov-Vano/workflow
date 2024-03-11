<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commander extends Model
{
    use HasFactory;

    public $modelTranslate = 'Руководители';

    protected $fillable = [
        'name',
        'short_name',
        'actual',
    ];
}
