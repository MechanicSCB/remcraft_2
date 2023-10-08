<?php

namespace App\Models;

use App\Classes\ImageHandler;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static array $formats = ['webp', 'w720', 'w480', 'w360', 'w200'];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    protected function origPath(): Attribute
    {
        return Attribute::make(
            get: fn() => storage_path("app/public/galleries/{$this->gallery->slug}/orig/$this->n.$this->e")
        );
    }

    public function remove()
    {
        // remove all Image files ('orig', 'webp', 'w720', ...)
        $origPath = $this->origPath;

        foreach (self::$formats as $format) {
            $formatPath = str_replace('/orig/', "/$format/", $origPath);
            $formatPath = str_replace(".$this->e", '.webp', $formatPath);
            unlink($formatPath);
        }

        unlink($origPath);

        $this->delete();
    }

    public function createOptimized()
    {
        (new ImageHandler())->createAndSaveOptimizedWepb($this);
    }
}
