<?php

namespace App\Models;

use App\Models\Classifiers\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'type',
        'name',
        'take_place_at',
        'organization_id',
        'place',
        'participants_before_at'
    ];
    /**
     * Метод получения оснований к проведению мероприятий
     *
     * @return BelongsToMany
     */
    public function incomings(): BelongsToMany
    {
        return $this->belongsToMany(Incoming::class, 'event_incoming');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

}
