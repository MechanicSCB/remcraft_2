<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('order');
    }
}
