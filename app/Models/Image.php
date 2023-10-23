<?php

namespace App\Models;

use App\Classes\ImageHandler;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static array $formats = [
        'webp',
        '720x480',
        '480x320',
        '360x240',
        '195x130'
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    protected function origPath(): Attribute
    {
        return Attribute::make(
            get: fn() => storage_path("app/public/galleries/{$this->gallery?->slug}/orig/$this->name.$this->ext")
        );
    }

    public function remove()
    {
        // remove all Image files ('orig', 'webp', 'w720', ...)
        $origPath = $this->origPath;

        foreach (self::$formats as $format) {
            $formatPath = str_replace('/orig/', "/$format/", $origPath);
            $formatPath = str_replace(".$this->ext", '.webp', $formatPath);
            File::delete($formatPath);
        }

        File::delete($origPath);

        $this->delete();
    }

    public function createOptimized()
    {
        (new ImageHandler())->createAndSaveOptimizedWepb($this);
    }
}
