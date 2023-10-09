<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];
    protected $appends = ['len'];

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('order');
    }

    protected function len(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->blocks()->count(),
        );
    }

    public function sluggable(): array
    {
        return ['slug' => ['source' => ['title', 'type']]];
    }
}
