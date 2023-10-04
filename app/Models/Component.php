<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    use HasFactory;

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
}
