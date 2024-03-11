<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
