<?php

namespace App\Models;

use App\Models\Classifiers\MediaType;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Registry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disc extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'name',
        'description',
        'confidential',
        'destroyed_at',
        'type_id',
        'registry_id',
        'number',
        'date'
    ];


    public function mediaType(): BelongsTo
    {
        return $this->BelongsTo(MediaType::class, 'type_id');
    }
    public function registry()
    {
        return $this->BelongsTo(Registry::class);
    }
    /**
     * Сотрудники, которые получили на себя диски
     */
    public function officers()
    {
        return $this->belongsToMany(Officer::class)
            ->withPivot('received_at', 'returned_at', 'note')
            ->withTimestamps();
    }
    public function performer()
    {
        return $this->belongsToMany(Officer::class)
            ->wherePivotNull('returned_at')
            ->latest();
    }
}
