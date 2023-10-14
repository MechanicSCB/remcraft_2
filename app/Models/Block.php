<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    use HasFactory, HasDatum;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function (Block $block) {
            // if order has been changed and saved refresh page ordering of blocks
            if($block->isDirty('order')){
                $block->page->refreshBlockOrders();
            }

        });
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
