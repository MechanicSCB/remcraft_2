<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected function datum(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => json_decode($value, 1),
            set: fn(?array $value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: function(?string $value) {
                if(is_null($value)){
                    $images = Storage::files("public/galleries/$this->src/webp");
                    $images = array_map(fn($v) => str_replace('public/galleries/', '/storage/galleries/', $v), $images);
                    $this->images = $images;
                    $this->save();

                    return $images;
                }

                return json_decode($value, 1);
            },
            set: fn(?array $value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }
}
