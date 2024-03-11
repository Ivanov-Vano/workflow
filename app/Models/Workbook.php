<?php

namespace App\Models;

use App\Models\Classifiers\Officer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  Workbook extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'book_id',
        'name',
        'destroyed_at',
        'registered_at',
        'confidential',
        'number',
        'page_count',
    ];

    public function officers()
    {
        return $this->belongsToMany(Officer::class)
            ->withTimestamps()
            ->withPivot(['received_at','returned_at']);
    }
    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
/*    public function workbookPerformers()
    {
        return $this->HasMany(OfficerWorkbook::class);
    }
    public function workbookPermormer()
    {
        return $this->hasOne(OfficerWorkbook::class)
            ->latest('received_at')
            ->where('returned_at', '=', null);
    }*/
}
