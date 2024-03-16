<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediaType extends Model
{
    use HasFactory;

    public string $modelTranslate = 'Типы носителей';

    protected $fillable =[
        'name',
        'short_name',
    ];
    public function media(): HasMany
    {
        return $this->hasMany('App\Models\Media');
    }
}
