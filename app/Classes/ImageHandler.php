<?php


namespace App\Classes;

use App\Models\Gallery;
use App\Models\Image;
use GdImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHandler
{
    public function createAndSaveOptimizedWepb(Image $image): void
    {
        $srcPath = $image->origPath;

        foreach (Image::$formats as $format){
            $targetPath = str_replace('/orig/',"/$format/", $srcPath);
            $targetPath = str_replace('.jpg','.webp', $targetPath);

            $targetDir = Str::beforeLast($targetPath, "/");

            if (! file_exists($targetDir)) {
                mkdir($targetDir);
            }

            if ($format === 'webp') {
                $this->jpgToWebp($srcPath, $targetPath);
            } else {
                [$width, $height] = explode('x',$format);
                $this->copyResizeToWebp($srcPath, $targetPath, $width, $height);
            }
        }
    }

    public function jpgToWebp(string $srcPath, string $targetPath, int $quality = 80): void
    {
        $srcImg = $this->createImageFromPath($srcPath);
        $w = imagesx($srcImg);
        $h = imagesy($srcImg);
        $newImg = imagecreatetruecolor($w, $h);
        imagecopy($newImg, $srcImg, 0, 0, 0, 0, $w, $h);

        //Сохранение
        imagewebp($newImg, $targetPath, $quality);
    }

    public function copyResizeToWebp(string $srcPath, string $storePath, int $newWidth, int $newHeight = null): ?string
    {
        $srcImg = $this->createImageFromPath($srcPath);

        $srcSize = getimagesize($srcPath);
        $srcWidth = $srcSize[0];
        $srcHeight = $srcSize[1];


        $ratio_orig = $srcWidth / $srcHeight;
        $ratio_target = $newWidth / $newHeight;

        if ( $ratio_orig >= $ratio_target )
        {
            // If src image is wider than target (in aspect ratio sense)
            $height = $newHeight;
            $width = $srcWidth / ($srcHeight / $newHeight);
        }
        else
        {
            // If the target is wider than the src image
            $width = $newWidth;
            $height = $srcHeight / ($srcWidth / $newWidth);
        }

        $newImg = imagecreatetruecolor($newWidth, $newHeight); //Создаем полноцветное изображение

        // Resize and crop
        imagecopyresampled($newImg, $srcImg, 0 - ($width - $newWidth) / 2, 0 - ($height - $newHeight) / 2, 0, 0, $width, $height, $srcWidth, $srcHeight);

        // Saving
        $storePath = str_replace('.jpg', '.webp', $storePath);
        imagewebp($newImg, $storePath);

        return 'Преобразование изображения выполнено без ошибок.';
    }

    protected function createImageFromPath(string $srcPath): GdImage|string
    {
        try {
            $fileType = Str::after(mime_content_type($srcPath), '/');

            if($fileType === 'jpeg'){
                $srcImg = imagecreatefromjpeg($srcPath);
            }elseif ($fileType === 'png'){
                $srcImg = imagecreatefrompng($srcPath);
            }elseif ($fileType === 'webp'){
                $srcImg = imagecreatefromwebp($srcPath);
            }elseif ($fileType === 'avif'){
                $srcImg = imagecreatefromavif($srcPath);
            }else{
                // TODO throw exception?
                return "$fileType формат не поддерживается!";
            }
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return $e->getMessage();
        }

        return $srcImg;
    }

    public function copyResizeToWebpAspectRatio(string $srcPath, string $storePath, int $newWidth, int $newHeight = null): void
    {
        $srcImg = $this->createImageFromPath($srcPath);
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
