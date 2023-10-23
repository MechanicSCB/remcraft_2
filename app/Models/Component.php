<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Component extends Model
{
    use HasFactory, HasSlug, HasDatum;

    protected $guarded = [];
    public static array $types = ['Html', 'Masonry', 'Calculator', 'Cost', 'Gallery', 'Pile', 'Recommendation', 'YoutubeChannel', 'Banner', 'Article', 'IFrame', 'Reply', 'Bid'];

    public static function getComponentsWithPages(): array
    {
        $components = [];
        $items = Component::query()
            ->leftJoin('blocks', 'blocks.component_id', '=', 'components.id')
            ->select(['components.id', 'title', 'type', 'page_id','components.updated_at'])
            ->get()
            ->groupBy('id')
            ->toArray();

        foreach ($items as $id => $item){
            $pages = array_filter(array_column($item,'page_id'));
            unset($item[0]['page_id']);
            $components[$id] = $item[0];
            $components[$id]['pages'] = $pages;
        }

        return $components;
    }

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

    protected function pages(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->blocks()->pluck('page_id'),
        );
    }
}
