<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Gallery extends Model
{
    // TODO create a method for checking galleries-images-imageFiles consistency
    use HasFactory, HasSlug;

    protected $guarded = [];

    /**
     * Get the images associated with the gallery.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('order');
    }

    /**
     * Get the component associated with the gallery.
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
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
        $images = $this->images()->get(['id', 'order', 'name', 'gallery_id'])->toArray();

        foreach ($images as $key => &$image) {
            $image['order'] = $key + 1;
        }

        Image::query()->upsert($images, 'id');
    }


    protected function folderPath(): Attribute
    {
        return Attribute::make(
            get: fn() => storage_path("app/public/galleries/{$this->slug}")
        );
    }
}
