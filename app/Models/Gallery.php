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

    //  ---------------- OLD -----------------
    // protected function images(): Attribute
    // {
    //     return Attribute::make(
    //         get: function(?string $value) {
    //             if(is_null($value)){
    //                 return $this->syncImages();
    //             }
    //
    //             return json_decode($value, 1);
    //         },
    //         set: fn(?array $value) => json_encode($value, JSON_UNESCAPED_UNICODE),
    //     );
    // }
    //
    // protected function origImagePaths(): Attribute
    // {
    //     return Attribute::make(
    //         get: function() {
    //             return Storage::files("public/galleries/$this->src/orig");
    //         },
    //     );
    // }

    /**
     * Rename all files in gallery's orig folder
     * and refresh optimized webp folders
     * and refresh gallery's model images field
     */
    // public function syncImages(): array
    // {
    //     // Rename all files in gallery's orig folder
    //     $origFilePaths = Storage::files("public/galleries/$this->slug/orig");
    //
    //     foreach ($origFilePaths as $key => &$origFilePath){
    //         $origDir = Str::beforeLast($origFilePath, '/');
    //         $newName = str_pad($key + 1, 3, 0, STR_PAD_LEFT);
    //         $ext = Str::afterLast($origFilePath,'.');
    //         $newFilePath = "$origDir/$newName.$ext";
    //         Storage::move($origFilePath, $newFilePath);
    //         $origFilePath = $newFilePath;
    //     }
    //
    //     // Refresh optimized webp folders
    //     (new ImageHandler())->createResized($this);
    //
    //     // Refresh gallery's model images field
    //     $this['images'] = array_map(fn($v) => ['orig' => Str::afterLast($v,'/')], $origFilePaths);
    //     $this->save();
    //
    //     return $this['images'];
    // }
    // protected function datum(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(?string $value) => json_decode($value, 1),
    //         set: fn(?array $value) => json_encode($value, JSON_UNESCAPED_UNICODE),
    //     );
    // }

}
