<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasDatum
{
    protected function datum(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => json_decode($value, 1),
        );
    }
}
