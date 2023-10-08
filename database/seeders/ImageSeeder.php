<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new DatabaseSeeder())->seedTable('images');
    }

    public function getImagesFromStorageFiles(): void
    {
        $images = [];

        $paths = Storage::allFiles('public/galleries');
        $paths = array_values(array_filter($paths, fn($v) => str_contains($v,'/orig/')));
        $galleries = Gallery::query()->pluck('id', 'slug');
        // dd(tmr(),$galleries);

        foreach ($paths as $path){
            $gallerySlug = Str::between($path,'/galleries/','/orig/');

            if(!($galleryId = @$galleries[$gallerySlug])){
                continue;
            }

            $ext = Str::afterLast($path,'.');
            $filename = Str::between($path,'/orig/', ".$ext");

            $images[] = [
                'o' => intval($filename),
                'n' => $filename,
                'e' => $ext,
                'gallery_id' => $galleryId,
            ];
        }

        clearDbTable('images');

        DB::table('images')->upsert($images, ['id']);
    }
}
