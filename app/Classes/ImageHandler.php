<?php


namespace App\Classes;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHandler
{
    public function createResized(Gallery $gallery)
    {
        $dir = "public/galleries/$gallery->slug";

        $imgPaths = Storage::files("$dir/orig");
        // dd(tmr(),$dir,$imgPaths);

        foreach ($imgPaths as $from) {
            $origExt = Str::afterLast($from, '.');
            $from = storage_path('app/' . $from);


            foreach (['webp', 'w720', 'w480', 'w360', 'w200'] as $size) {
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

        dd(tmr(), $gallery);
    }

    public function jpgToWebp(string $srcPath, string $targetPath, int $quality = 80): void
    {
        try {
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
        //imagealphablending($newImg, false); //Отключаем режим сопряжения цветов
        //imagesavealpha($newImg, true); //Включаем сохранение альфа канала

        //Ресайз
        imagecopyresampled($newImg, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

        //Сохранение
        //imagepng($newImg, $storePath);
        $storePath = str_replace('.jpg', '.webp', $storePath);
        imagewebp($newImg, $storePath);
        // imagejpeg($newImg, $storePath);
    }
}
