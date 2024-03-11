<?php

namespace App\Models\Classifiers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'name_short',
        'number',
        'sort',
        'actual',
        'parent_id',
    ];
    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id', 'id')->withDefault();
    }

}
