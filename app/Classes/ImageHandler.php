<?php


namespace App\Classes;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHandler
{
    public function createAndSaveOptimizedWepb(Image $image)
    {
        $srcPath = $image->origPath;

        foreach (Image::$formats as $format){
            $targetPath = str_replace('/orig/',"/$format/", $srcPath);
            $targetPath = str_replace('.jpg','.webp', $targetPath);

            $targetDir = Str::beforeLast($targetPath, "/");

            if (! file_exists($targetDir)) {
                mkdir($targetDir);
            }

            $this->jpgToWebp($srcPath, $targetPath);
            if ($format === 'webp') {
                $this->jpgToWebp($srcPath, $targetPath);
            } else {
                $size = +substr($format, 1);
                $this->copyResizeJpgAspectRatio($srcPath, $targetPath, $size);
            }
        }

    }

    public function createResized(Gallery $gallery): bool
    {
        $dir = "public/galleries/$gallery->slug";

        // Delete all previous resized directories
        foreach (Image::$formats as $subDir){
            Storage::deleteDirectory("$dir/$subDir");
        }

        $imgPaths = Storage::files("$dir/orig");

        foreach ($imgPaths as $from) {
            $origExt = Str::afterLast($from, '.');
            $from = storage_path('app/' . $from);

            foreach (Image::$formats as $size) {
                $to = str_replace('/orig/', "/$size/", $from);
                $to = str_replace(".$origExt", '.webp', $to);

                if (!Storage::exists($to)) {
                    Storage::makeDirectory(Str::beforeLast(Str::after($to, 'storage/app/'), '/'));
                }

                if ($size === 'webp') {
                    $this->jpgToWebp($from, $to);
                } else {
                    $size = +substr($size, 1);
                    $this->copyResizeJpgAspectRatio($from, $to, $size);
                }
            }
        }

        return true;
    }

    public function jpgToWebp(string $srcPath, string $targetPath, int $quality = 80): void
    {
        try {
            // TODO add other extension
            $srcImg = imagecreatefromjpeg($srcPath);
        } catch (\Exception $e) {
            // log
            dd(tmr(), $e);
            return;
        }

        $w = imagesx($srcImg);
        $h = imagesy($srcImg);
        $newImg = imagecreatetruecolor($w, $h);
        imagecopy($newImg, $srcImg, 0, 0, 0, 0, $w, $h);

        //Сохранение
        imagewebp($newImg, $targetPath, $quality);
    }

    public function copyResizeJpgAspectRatio(string $srcPath, string $storePath, int $newWidth, int $newHeight = null): void
    {
        try {
            // TODO add other extension
            $srcImg = imagecreatefromjpeg($srcPath);
        } catch (\Exception $e) {
            // log
            dd(tmr(), $e);
            return;
        }

        $srcSize = getimagesize($srcPath);
        $srcWidth = $srcSize[0];
        $srcHeight = $srcSize[1];

        $ratio_orig = $srcWidth / $srcHeight;
        if ($newHeight && $newWidth / $newHeight > $ratio_orig) {
            $newWidth = $newHeight * $ratio_orig;
        } else {
            $newHeight = $newWidth / $ratio_orig;
        }

        $newImg = imagecreatetruecolor($newWidth, $newHeight); //Создаем полноцветное изображение

        //Ресайз
        imagecopyresampled($newImg, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

        //Сохранение
        $storePath = str_replace('.jpg', '.webp', $storePath);
        imagewebp($newImg, $storePath);
    }
}
