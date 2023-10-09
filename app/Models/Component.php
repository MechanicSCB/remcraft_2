<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Component extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    protected function datum(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => json_decode($value, 1),
            set: fn(?array $value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class)->orderBy('order');
    }

    public function block(): HasOne
    {
        return $this->hasOne(Block::class);
    }

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }
}
