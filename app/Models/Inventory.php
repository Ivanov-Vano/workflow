<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'number',
        'date',
        'book_id',
        'document_id',
    ];
    public function book()
    {
        return $this->BelongsTo(Book::class);
    }
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function officers()
    {
        return $this->belongsToMany('App\Models\Classifiers\Officer')
            ->withTimestamps()
            ->withPivot(['registered','returned']);
    }
    public function inventoryPerformers()
    {
        return $this->HasMany(InventoryOfficer::class);
    }
    public function inventoryPermormer()
    {
        return $this->hasOne(InventoryOfficer::class)
            ->latest('received_at')
            ->where('returned_at', '=', null);
    }

}
