<?php

namespace App\Models;

use App\Models\Accesses\User;
use App\Models\Classifiers\Node;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Option;
use App\Models\Classifiers\Organization;
use App\Models\Classifiers\Registry;
use App\Models\Classifiers\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outgoing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'note',
        'name',
        'page_count',
        'confidential',
        'registry_id',
        'created_at',
        'date',
        'page_start',
        'exemplar_count',
        'number',
        'registry_part',
        'updated_who',
        'updated_at',
        'image',
        'organization_id',
        'option_id',
        'created_who',
        'description',
        'officer_id'
    ];
    /**
     * Получить все вложения для исходящего.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::Class, 'attachmentable');
    }

    /**
     * Получить всех ответственных для исходящего.
     */
    public function nodes(): MorphToMany
    {
        return $this->morphToMany(Node::class, 'nodeable')
            ->withTimestamps();
    }
/*    public function nodes()
    {
        return $this->belongsToMany(Node::class)
            ->withTimestamps();
    }*/

    /**
     * Получить все приложения (вложения) в виде носителя для исходящих.
     */
    public function discs(): MorphToMany
    {
        return $this->morphToMany(Disc::class, 'discable')->withTimestamps();
    }

    /**
     * Получить все теги для исходящих.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }
    public function officer(): BelongsTo
    {
        return $this->belongsTo(Officer::class);
    }
    public function registry(): BelongsTo
    {
        return $this->belongsTo(Registry::class);
    }
    public function createdWho(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_who', 'id');
    }
    public function updatedWho(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_who', 'id');
    }
}
