<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];
    // protected $appends = ['len'];

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

    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
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

    /**
     * Refresh blocks ordering.
     */
    public function refreshBlockOrders()
    {
        $blocks = $this->blocks()->get(['id', 'order','page_id'])->toArray();

        foreach ($blocks as $key => &$block) {
            $block['order'] = $key + 1;
        }

        Block::query()->upsert($blocks, 'id');
    }
}
