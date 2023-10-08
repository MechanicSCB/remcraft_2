<?php

namespace App\Actions\Images;

use App\Classes\ImageHandler;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncGalleryImages
{
    public function __construct(protected Gallery $gallery)
    {
        //
    }

    public function __invoke()
    {
        // Rename all files in gallery's orig folder
        $origFilePaths = Storage::files("public/galleries/{$this->gallery->slug}/orig");

        foreach ($origFilePaths as $key => &$origFilePath){
            $origDir = Str::beforeLast($origFilePath, '/');
            $newName = str_pad($key + 1, 3, 0, STR_PAD_LEFT);
            $ext = Str::afterLast($origFilePath,'.');
            $newFilePath = "$origDir/$newName.$ext";
            Storage::move($origFilePath, $newFilePath);
            $origFilePath = $newFilePath;
        }

        // Refresh optimized webp folders
        (new ImageHandler())->createResized($this->gallery);

        // Refresh gallery's model images field
        $this->gallery['images'] = array_map(fn($v) => ['orig' => Str::afterLast($v,'/')], $origFilePaths);
        $this->gallery->save();

        return $this->gallery['images'];
    }
}
