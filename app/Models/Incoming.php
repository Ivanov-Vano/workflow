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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incoming extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['mainNode'];

    protected $fillable =[
        'number',
        'date',
        'name',
        'sender_number',
        'sender_date',
        'sender_name',
        'sender_phone',
        'organization_id',
        'option_id',
        'description',
        'page_count',
        'page_start',
        'confidential',
        'exemplar_count',
        'image',
        'registry_id',
        'resolution',
        'deadline',
        'completed_at',
        'officer_id',
        'is_complete',
        'registry_part',
        'importance',
        'result_text',
        'whose_resolution',
        'created_who',
        'updated_who',
        'sign_completed_who',
        'sign_completed_at',
        'is_internal',
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
     * Получить все приложения (вложения) в виде носителя для входящих.
     */
    public function discs(): MorphToMany
    {
        return $this->morphToMany(Disc::class, 'discable')->withTimestamps();
    }

    /**
     * Получить все теги для входящих.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    /**
     * Получить всех ответственных для входящего.
     */
    public function nodes(): MorphToMany
    {
        return $this->morphToMany(Node::class, 'nodeable')
            ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
            ->withTimestamps();
    }
    /*    public function nodes(): BelongsToMany
        {
            return $this->belongsToMany(Node::class)
                ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
                ->withTimestamps();
        }*/
        public function mainNode(): BelongsToMany
        {
            return $this->morphToMany(Node::class, 'nodeable')
                ->withPivot('is_main', 'is_personal', 'comment', 'viewed_at', 'report_text', 'report')
                ->withTimestamps()
                ->where('is_main', '=', true);
        }

    /**
     * Получить получателя для входящего.
     */
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
    public function whoseResolution(): BelongsTo
    {
        return $this->belongsTo(Officer::class, 'whose_resolution', 'id');
    }
    public function createdWho(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_who', 'id');
    }
    public function updatedWho(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_who', 'id');
    }
    public function signCompletedWho(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sign_completed_who', 'id');
    }

}
