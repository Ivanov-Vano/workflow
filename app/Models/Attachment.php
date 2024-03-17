<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'description',
        'page_count',
        'page_start',
        'confidential',
        'image',
    ];
    /**
     * Получить родительский attachmentable model (incoming or outgoing).
     */
    public function attachmentable(): MorphTo
    {
        return $this->morphTo();
    }
}
