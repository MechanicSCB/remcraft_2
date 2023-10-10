<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Gallery extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('o');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingLanguage('ru')
            ->startSlugSuffixFrom(2);
    }

    public function refreshOrders()
    {
        $images = $this->images()->get(['id', 'o', 'n'])->toArray();

        foreach ($images as $key => &$image) {
            $image['o'] = $key + 1;
        }

        Image::query()->upsert($images, 'id');
    }
}
