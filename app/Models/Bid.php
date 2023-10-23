<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Bid extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the comment's created_at datetime with Moscow timezone
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::make($value)->setTimezone('Europe/Moscow')->format('d.m.Y H:i'),
        );
    }

    /**
     * Get the comment's updated_at datetime with Moscow timezone
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::make($value)->setTimezone('Europe/Moscow')->format('d.m.Y H:i'),
        );
    }
}
