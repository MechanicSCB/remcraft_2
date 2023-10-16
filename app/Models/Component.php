<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Component extends Model
{
    use HasFactory, HasSlug, HasDatum;

    protected $guarded = [];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class)->orderBy('order');
    }

    public function blocks(): hasMany
    {
        return $this->hasMany(Block::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title', 'type'])
            ->saveSlugsTo('slug')
            ->usingLanguage('ru')
            ->startSlugSuffixFrom(2);
    }
}
