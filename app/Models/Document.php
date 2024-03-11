<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    const FILES_DISK = 'public';

    public $modelTranslate = 'Документы';

    protected $fillable =[
        'name',
        'description',
        'page_count',
        'confidential',
        'exemplar_count',
        'date',
        'image',
        'officer_id',
    ];
    public function officer()
    {
        return $this->belongsTo('App\Models\Classifiers\Officer');
    }
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Classifiers\Node')
            ->withTimestamps()
            ->withPivot(['review']);
    }
    /**
     * документ может быть приложением.
     */
    public function attachment()
    {
        return $this->belongsTo('App\Models\DocumentAttachment');
    }
}
