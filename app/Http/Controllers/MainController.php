<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\ResponseFactory;

class MainController extends Controller
{
    public function test(): Response|ResponseFactory
    {
        $images = [

            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/001.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/002.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/003.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/004.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/005.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/006.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/007.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/008.webp',
            '/storage/galleries/aprelevka-ul-parkovaya-d-11-kvartira-120-mkv/webp/009.webp',
        ];

        return inertia('Test', compact('images'));
    }
}