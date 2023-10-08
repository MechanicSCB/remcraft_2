<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Page;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ImageSeeder;
use Inertia\Response;
use Inertia\ResponseFactory;

class MainController extends Controller
{
    public function reverse()
    {
        (new DatabaseSeeder())->reverse();
    }

    public function test()
    {
        dd(tmr(),'test');
    }

    public function admin(): Response|ResponseFactory
    {
       return inertia('Admin/Index');
    }

    public function index(): Response|ResponseFactory
    {
        // TODO load galleries only for galleries
        $page = Page::query()->with('blocks.component.galleries.images')->find(1);

        return inertia('Pages/Show',  compact('page'));
    }
}
