<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function subItems(): HasMany
    {
        return $this->hasMany(Item::class, 'parent_id')->with('subItems');
    }

    protected function href(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->page?->slug ?? $value,
        );
    }
}
