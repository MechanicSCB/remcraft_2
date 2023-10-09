<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('o');
    }

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title'],
            'src' => ['source' => 'title'],
        ];
    }

    public function refreshOrders()
    {
        $images = $this->images()->get(['id','o','n'])->toArray();

        foreach ($images as $key => &$image){
            $image['o'] = $key+1;
        }

        Image::query()->upsert($images, 'id');
    }
}
