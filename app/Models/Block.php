<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    use HasFactory, HasDatum;

    protected $guarded = [];

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
