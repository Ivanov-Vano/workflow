<?php

namespace App\Models;

use App\Models\Accesses\User;
use App\Models\Classifiers\Commander;
use App\Models\Classifiers\Node;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Registry;
use App\Models\Classifiers\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decree extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'number',
        'date',
        'name',
        'description',
        'page_count',
        'page_start',
        'confidential',
        'exemplar_count',
        'image',
        'registry_id',
        'type',
        'incoming_id',
        'commander_id',
        'registry_part',
        'created_who',
        'updated_who',
        'signed_who',
        'created_at',
        'updated_at',
    ];

    /**
     * Получить все вложения для входящего.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::Class, 'attachmentable');
    }

    /**
     * Получить всех ответственных для входящего.
     */
    public function nodes()
    {
        return $this->belongsToMany(Node::class)
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps();
    }
    public function mainNode()
    {
        return $this->belongsToMany(Node::class)
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps()
            ->where('is_main', '=', true);
    }

    /**
     * Получить все теги для входящих.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function incoming(): BelongsTo
    {
        return $this->belongsTo(Incoming::class);
    }
    public function commander(): BelongsTo
    {
        return $this->belongsTo(Commander::class);
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
    public function signedWho(): BelongsTo
    {
        return $this->belongsTo(Officer::class,  'signed_who', 'id');
    }
}
