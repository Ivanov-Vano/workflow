<?php

namespace App\Models\Classifiers;

use App\Models\Accesses\User;
use App\Models\Decree;
use App\Models\DocumentIncoming;
use App\Models\Incoming;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    public $modelTranslate = 'Ответственные';

    protected $fillable =[
        'name',
        'name_short',
        'number',
        'sort',
        'actual',
        'parent_id'
    ];
    public function documents()
    {
        return $this->belongsToMany('App\Models\Document')->withTimestamps();
    }
    public function officers()
    {
        return $this->belongsToMany('App\Models\Officer')->withTimestamps();
    }
    /**
     * Выбираем все входящие к ответственным
     */
    public function incomings()
    {
        return $this->belongsToMany(Incoming::class)
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps();
    }
    /**
     * Выбираем все приказы к ответственным
     */
    public function decrees()
    {
        return $this->belongsToMany(Decree::class)
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps();
    }
    /**
     * Выбираем ответственного в качестве родителя.
     */
    public function parent()
    {
        return $this->belongsTo(Node::class, 'parent_id', 'id')->withDefault();
    }

    /**
     * Пользователи, которые входя в подразделение.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
