<?php

namespace App\Models\Classifiers;

use App\Models\Accesses\User;
use App\Models\Disc;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;


class Officer extends Model
{
    use HasFactory;

    public $modelTranslate = 'Сотрудники';

    protected $fillable =[
        'surname',
        'name',
        'patronymic',
        'full_name',
        'birthdate',
        'gender',
        'sign_image',
        'post',
        'actual',
        'personal_number',
        'phone',
        'rank_id',
        'department_id',
    ];
    protected static function boot()
    {
        parent::boot();

/*        self::addGlobalScope('restriction', function (Builder $builder){
            if (!(auth()->user()->hasAnyRole(['Администратор', 'Суперпользователь', 'Делопроизводитель']))) { //todo : не работает seeder ругается  Call to a member function hasAnyRole() on null
                $builder->whereHas('department', function ($query) {
                    $department = DB::table('officers')
                        ->join('users','officers.id', '=', 'users.officer_id')
                        ->where('users.id', auth()->id())->first();
                    $query
                        ->where('id', '=', $department->department_id)
                        ->orWhere('parent_id', '=', $department->department_id);
                });
            }
        });*/
    }

    public function rank()
    {
        return $this->belongsTo('App\Models\Classifiers\Rank');
    }
    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class)->withDefault();
    }
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Classifiers\Node')->withTimestamps();
    }
    public function workbooks()
    {
        return $this->belongsToMany('App\Models\Workbook')->withTimestamps();
    }
    public function inventories()
    {
        return $this->belongsToMany('App\Models\Inventory')->withTimestamps();
    }
    public function getFio()
    {
        return $this->person()->surname.' '.mb_substr($this->person()->name, 0, 1).'. '.mb_substr($this->person()->patronymic, 0, 1).'.';
    }
    public function user()
    {
        return $this->HasOne(User::class);
    }
    /**
     * Сотрудники, которые получали диски that belong to the role.
     */
    public function discs()
    {
        return $this->belongsToMany(Disc::class);
    }}
