<?php

namespace App\Models\Classifiers;

use App\Models\Accesses\User;
use App\Models\Decree;
use App\Models\Incoming;
use App\Models\Outgoing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Node extends Model
{
    use HasFactory;

    public string $modelTranslate = 'Ответственные';

    protected $fillable =[
        'name',
        'name_short',
        'number',
        'sort',
        'actual',
        'parent_id'
    ];
    public function officers(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Officer')->withTimestamps();
    }
    /**
     * Выбираем все входящие к ответственным
     */
    public function incomings(): MorphToMany
    {
/*        return $this->belongsToMany(Incoming::class)*/
        return $this->morphedByMany(Incoming::class, 'nodeable')
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps();
    }
    /**
     * Выбираем все приказы к ответственным
     */
    public function decrees()
    {
//        return $this->belongsToMany(Decree::class)
        return $this->morphedByMany(Decree::class, 'nodeable')
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps();
    }
    /**
     * Выбираем все исходящие к ответственным
     */
    public function outgoings()
    {
        return $this->morphedByMany(Outgoing::class, 'nodeable')
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
